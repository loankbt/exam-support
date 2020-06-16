/*
Serial-to-websocket Server using serialport.js
*/

// include the various libraries that in need
var SerialPort = require('serialport');			// include serialport library
// var	portName =  process.argv[2];						// get the port name from the command line
var WebSocketServer = require('ws').Server;   // include webSocket library

// configure the webSocket server:
var SERVER_PORT = 8081;                 // port number for the webSocket server
var wss = new WebSocketServer({port: SERVER_PORT}); // the webSocket server
var connections = new Array;            // list of connections to the server

var myPort = new SerialPort("COM3", 9600);// open the port
var Readline = SerialPort.parsers.Readline;	// make instance of Readline parser
var parser = new Readline();								// make a new parser to read ASCII lines
myPort.pipe(parser);													// pipe the serial stream to the parser

// these are the definitions for the serial events:
myPort.on('open', showPortOpen);    // called when the serial port opens
myPort.on('close', showPortClose);  // called when the serial port closes
myPort.on('error', showError);   // called when there's an error with the serial port
parser.on('data', readSerialData);  // called when there's new data incoming


// ------------------------ Serial event functions:
// this is called when the serial port is opened:
function showPortOpen() {
  console.log('Port open. Data rate: ' + myPort.baudRate);
}

// this is called when new data comes into the serial port:
function readSerialData(data) {
  // if there are webSocket connections, send the serial data
  // to all of them:
  console.log(data);
  if (connections.length > 0) {
    broadcast(data);
  }
}

function showPortClose() {
   console.log('Port closed');
}

function showError(error) {
  console.log('Serial port error: ' + error);
}

function sendToSerial(data) {
  console.log("Sending to serial: " + data);
  myPort.write(data);
}

// ---- webSocket Server event functions
wss.on('connection', handleConnection);

function handleConnection(client) {
  console.log("New Connection");        // you have a new client
  connections.push(client);             // add this client to the connections array

  client.on('message', sendToSerial);      // when a client sends a message,

  client.on('close', function() {           // when a client closes its connection
    console.log("Connection closed");       // print it out
    var position = connections.indexOf(client); // get the client's position in the array
    connections.splice(position, 1);        // and delete it from the array
  });
}

// This function broadcasts messages to all webSocket clients
function broadcast(data) {
  for (c in connections) {     // iterate over the array of connections
    connections[c].send(JSON.stringify(data)); // send the data to each connection
  }
}