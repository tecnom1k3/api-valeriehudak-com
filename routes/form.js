'use strict';

const express = require('express');
const formModule = require('./../modules/form');
const router = express.Router();

router.post('/', function (req, res, next) {
    formModule.sendForm(req.body).then((data) => {
        res.json({
            "messageId": data.MessageId
        });
    }).catch((err) => {
        res.json({
            "error": err.toString()
        });
    });
});

module.exports = router;