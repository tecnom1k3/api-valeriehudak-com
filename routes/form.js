'use strict';

const express = require('express');
const AWS = require('aws-sdk');
const router = express.Router();

const awsConfig = {
    "accessKeyId": process.env.SES_AWS_ACCESS_KEY_ID,
    "secretAccessKey": process.env.SES_AWS_SECRET_ACCESS_KEY,
    "region": process.env.SES_AWS_REGION
};

AWS.config.update(awsConfig);

// Create sendEmail params
let params = {
    Destination: { /* required */
        ToAddresses: [
            process.env.TO_ADDRESS,
            /* more items */
        ]
    },
    Message: { /* required */
        Body: { /* required */
            // Html: {
            //     Charset: "UTF-8",
            //     Data: "HTML_FORMAT_BODY"
            // },
            Text: {
                Charset: "UTF-8",
                Data: ""
            }
        },
        Subject: {
            Charset: 'UTF-8',
            Data: process.env.MAIL_SUBJECT
        }
    },
    Source: process.env.FROM_ADDRESS, /* required */
    ReplyToAddresses: [
        process.env.FROM_ADDRESS,
        /* more items */
    ],
};

router.post('/', function (req, res, next) {

    params.Message.Body.Text.Data = req.body.message;
    let sendPromise = new AWS.SES({apiVersion: '2010-12-01'}).sendEmail(params).promise();
    sendPromise.then(
        function(data) {
            res.json({
                "messageId": data.MessageId
            });
        }).catch(
        function(err) {
            res.json({
                "error": err.toString()
            });
        });
});

module.exports = router;