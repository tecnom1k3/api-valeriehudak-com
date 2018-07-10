'use strict';

const serverless = require('serverless-http');
const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const indexRoute = require('./routes/index');
const pingRoute = require('./routes/ping');
const formRoute = require('./routes/form');

app.use(bodyParser.json());

app.use('/', indexRoute);
app.use('/ping', pingRoute);
app.use('/form', formRoute);

module.exports.handler = serverless(app);