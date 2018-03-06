var connection = require('./db');

exports.checkNumber = function(data,callback){
	var m_queue_id = data.m_queue_id;
	var store_id = data.store_id;
	var initDate = new Date();
	var date = initDate.getFullYear() + "-" + parseInt(initDate.getMonth()+1) + "-" + initDate.getDate();
	connection.query("SELECT * FROM apps_queue WHERE apps_queue.m_queue_id = ? AND apps_queue.date_created = ? AND apps_queue.store_id = ? ORDER BY apps_queue.queue_id DESC LIMIT 1",[m_queue_id,date,store_id], function (err, result, fields) {
		connection.query("SELECT * FROM apps_master_queue WHERE m_queue_id = ?",[m_queue_id], function(err,resultM){
			
			var firstWord = resultM[0].first_word;

			if(result.length == 0){

				spl2 = 1;
			}
			else{

				var spl1 = result[0].queue_number;
				var spl2 = parseInt(spl1.split(" ")[1]) + 1;
			}

			

			var autoNumber = firstWord + " " +spl2;
			var valInsert = {
				'm_queue_id':m_queue_id,
				'queue_number' : autoNumber,
				'date_created' : date,
				'store_id' : store_id
			};
			var i = 0;



			var getNum = function(ma){

			var master = [];

				
			connection.query("SELECT * FROM apps_master_queue WHERE is_deleted = 0", function(err, res){

				res.forEach(function(resM){
					i++;
					var m_id = resM.m_queue_id;
					connection.query("SELECT * FROM apps_queue WHERE m_queue_id = ? AND date_created = ? AND store_id = ?", [m_id,date,store_id], function(er,num){
						
						master.push(num.length);
						ma(master);
					})
				});

			})



			}


			


			connection.query("INSERT INTO apps_queue SET ?",valInsert, function(err, resultInsert){
				var returnData = {
					store_id : store_id,
					number : autoNumber,
					m_queue_id : m_queue_id
				}
				callback(returnData);
			})
		})
		
	});
}

exports.updateID = function(user_id,data,callback){
	var valUpdate = {
		socket_id : data,
		status : 'online'
	}
	connection.query("UPDATE apps_users SET ? WHERE user_id = ?",[valUpdate,user_id], function(err,res){
		connection.query("SELECT * FROM apps_users WHERE user_id = ?",[user_id],function(err, rows){
			if(callback)
				callback(rows)
		});
	})
}

exports.updateOff = function(socket_id,callback){
	var valUpdate = {
		status : 'offline'
	}
	connection.query("SELECT * FROM apps_users WHERE socket_id = ?",[socket_id],function(err, r){
		if (r.length > 0) {

			connection.query("UPDATE apps_users SET ? WHERE socket_id = ?",[valUpdate,socket_id], function(err,res){
				if(callback)
				callback(r[0])
			});
			
		}
		else{
			callback(null);
		}
	})
}


exports.getPoeple = function(store_id,callback){
	connection.query("SELECT * FROM apps_users WHERE store_id = ? AND status = 'online'",[store_id], function(err,rows){
		callback(rows);
		
	})
}

exports.updateQueue = function(data,callback){

	var dataUpdate = {
		is_done : 1
	}
	var queue_id = data.queue_id;

	connection.query("UPDATE apps_queue SET ? WHERE queue_id = ?",[dataUpdate,queue_id],function(err,res){
		if (callback)
		callback()

	})
}

