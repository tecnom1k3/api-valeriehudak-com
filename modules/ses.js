'use strict';

const awsModule = require('./aws');

const sesModule = (function (awsModule) {

    const sesApiVersion = '2010-12-01';
    const awsClient = awsModule.getAws();
    const sesClient = new awsClient.SES({apiVersion: sesApiVersion});

    let params = {
        Destination: {
            ToAddresses: [
            ]
        },
        Message: {
            Body: {
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
                Data: ''
            }
        },
        Source: '', /* required */
        ReplyToAddresses: [
        ],
    };

    /**
     *
     * @param from
     * @param to
     * @param subject
     * @param message
     * @returns {{Destination: {ToAddresses: Array}, Message: {Body: {Text: {Charset: string, Data: string}}, Subject: {Charset: string, Data: string}}, Source: string, ReplyToAddresses: Array}}
     */
    const getParams = function (from, to, subject, message) {
        params.Destination.ToAddresses = [to];
        params.Source = from;
        params.ReplyToAddresses = [from];
        params.Message.Subject.Data = subject;
        params.Message.Body.Text.Data = message;
        return params;
    };

    /**
     *
     * @param params
     * @returns {Promise<PromiseResult<SES.SendEmailResponse, AWSError>>}
     */
    const send = (params) => sesClient.sendEmail(
        getParams(params.from, params.to, params.subject, params.message)
    ).promise();

    return {
        send: send
    }

})(awsModule);

module.exports = sesModule;