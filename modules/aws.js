'use strict';

const AWS = require('aws-sdk');

const awsModule = (function (AWS) {
    const awsConfig = {
        "accessKeyId": process.env.SES_AWS_ACCESS_KEY_ID,
        "secretAccessKey": process.env.SES_AWS_SECRET_ACCESS_KEY,
        "region": process.env.SES_AWS_REGION
    };

    AWS.config.update(awsConfig);

    const getAws = () => AWS;

    return {
        getAws: getAws
    }

})(AWS);

module.exports = awsModule;