var express = require('express');
var app = express();
var http = require('http').Server(app);
var myConnections = require("express-myconnection");
var io = require('socket.io')(http);
var connection = require('./db');
var queue = require('./queue');

/*app.use(myConnections(mysql,{
	host : 'localhost',
	user : 'root',
	password : '',
	database : 'db_pos'
},'pool'));*/

/*var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'db_pos'
});
connection.connect();*/


io.on('connection', function(socket){

	socket.on('come', function(msg){
		var socketId = socket.id;
		var store_id = msg.store_id;
		socket.join(store_id);

		queue.updateID(msg.user_id,socket.id, function(dataSend){
			queue.getPoeple(store_id, function(data){

				io.to(store_id).emit("come",data);
				
			})
		});

		
		console.log("New ID "+socket.id);

	})

//io.in(data.store_id).emit("queue",data);

	socket.on('queue', function(msg){
		queue.checkNumber(msg, function(data){
			
			socket.emit("queue", data);
			io.in(data.store_id).emit("updateNum");

		});

	})

	/*Eeven mendapat panggilan antrian*/

	socket.on("calling", function(msg){
		var store_id = msg.store_id;
		queue.updateQueue(msg,function(){
			
			io.to(store_id).emit("updateNum");
			io.to(store_id).emit("calling",msg);

		})

	})

	socket.on("callAgain", function(msg){
		var queue_number = msg.queue_number;
		var no_loket = msg.no_loket;
		var store_id = msg.store_id;

		var dataObj = {
			queue_number : queue_number,
			no_loket : no_loket,
			store_id : store_id
		}

		io.to(store_id).emit("callAgain",dataObj);


	})





	socket.on('disconnect', function(){
		var socket_id = socket.id;
		queue.updateOff(socket_id, function(data){
			if (data != null){
				var store_id = data.store_id;
				socket.leave(store_id);
				io.to(store_id).emit("leave", data);
			}
		});
	})


});
//app.get("/", )



http.listen(3000, function(){


})
