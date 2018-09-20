'use strict';

const express = require('express');
const formModule = require('./../modules/form');
const router = express.Router();
const cors = require('cors');

router.options('/', cors());

router.post('/', cors(), function (req, res, next) {
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