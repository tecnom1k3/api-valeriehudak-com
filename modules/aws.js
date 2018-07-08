'use strict';

const AWS = require('aws-sdk');

const awsModule = (function (AWS) {

    const getAws = () => AWS;

    return {
        getAws: getAws
    }

})(AWS);

module.exports = awsModule;