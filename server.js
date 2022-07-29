const express = require('express');

const app = express();

const server = require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: { origin: "*" }
});

const mysql = require('mysql');
const moment = require('moment');
const sockets = {};

const conn = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'simple_crud'
});

conn.connect(function (err) {
    if (err)
        throw err;
    console.log("Database connected");
});

io.on('connection', (socket) => {

    //STATUS USER
    if (!sockets[socket.handshake.query.user_id]) {
        sockets[socket.handshake.query.user_id] = [];
    }
    sockets[socket.handshake.query.user_id].push(socket);
    socket.broadcast.emit('user_connection', socket.handshake.query.user_id);

    conn.query(`UPDATE users SET is_online = 1 where id = ${socket.handshake.query.user_id}`, function (err, res) {
        if (err)
            throw err;
        console.log("User Connected", socket.handshake.query.user_id);
    });

    socket.on('disconnect', function (err) {
        socket.broadcast.emit('user_disconnected', socket.handshake.query.user_id);
        for (var index in sockets[socket.handshake.query.user_id]) {
            if (socket.id == sockets[socket.handshake.query.user_id][index].id) {
                sockets[socket.handshake.query.user_id].splice(index, 1);
            }
        }
        conn.query(`UPDATE users SET is_online = 0 where id = ${socket.handshake.query.user_id}`, function (err, res) {
            if (err)
                throw err;
            console.log("User Disconnected", socket.handshake.query.user_id);
        });
    })

    //MESSAGE
    socket.on('send_message', function (data) {
        let group_id = (data.user_id > data.other_user_id) ? data.user_id + data.other_user_id : data.other_user_id + data.user_id;
        let time = moment().format("h:mm A");
        data.time = time;
        for (let index in sockets[data.user_id]) {
            sockets[data.user_id][index].emit('receive_message', data);
        }
        for (let index in sockets[data.other_user_id]) {
            sockets[data.other_user_id][index].emit('receive_message', data);
        }

        conn.query(`INSERT INTO chats (user_id, other_user_id, message, group_id) values (${data.user_id}, ${data.other_user_id}, '${data.message}', '${group_id}')`, function (err, res) {
            if (err)
                throw err
            console.log("Message sent");
        });
    });

    // socket.on('sendDataToServer', (data) => {
    //     // console.log(data)

    //     io.sockets.emit('sendDataToClient', data);
    //     // socket.broadcast.emit('sendDataToClient', data);
    // });

    //CHATAPP
    // socket.on('sendMessageToServer', (message) => {
    //     console.log(message)

    //     io.sockets.emit('sendMessageToClient', message);
    //     socket.broadcast.emit('sendMessageToClient', message);
    // });

    // socket.on('disconnect', (socket) => {
    //     console.log('Disconnect')
    // });
});

server.listen(3000, () => {
    console.log('Server is running');
});
