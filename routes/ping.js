'use strict';

const express = require('express');
const router = express.Router();

router.get('/', function (req, res, next) {

    let date = new Date();

    res.json({
        timestamp: date.getTime()
    });
});

module.exports = router;