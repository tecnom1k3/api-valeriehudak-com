'use strict';

const awsModule = require('./aws');

const sesModule = (function (awsModule) {

    const sesApiVersion = '2010-12-01';
    const aws = awsModule.getAws();
    const ses = new aws.SES({apiVersion: sesApiVersion});

    /**
     *
     * @param params
     * @returns {Promise<PromiseResult<SES.SendEmailResponse, AWSError>>}
     */
    const send = (params) => ses.sendEmail(params)
        .promise();

    return {
        send: send
    }

})(awsModule);

module.exports = sesModule;