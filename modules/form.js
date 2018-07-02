'use strict';

const ses = require('./ses');

const formModule = (function (ses) {

    // Create sendEmail params
    let params = {
        Destination: {
            ToAddresses: [
                process.env.TO_ADDRESS,
                /* more items */
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
                Data: process.env.MAIL_SUBJECT
            }
        },
        Source: process.env.FROM_ADDRESS, /* required */
        ReplyToAddresses: [
            process.env.FROM_ADDRESS,
        ],
    };

    /**
     *
     * @param message
     * @returns {{Destination: {ToAddresses: *[]}, Message: {Body: {Text: {Charset: string, Data: string}}, Subject: {Charset: string, Data: string | undefined}}, Source: string | undefined, ReplyToAddresses: *[]}}
     */
    const getParams = function (message) {
        params.Message.Body.Text.Data = message;
        return params;
    };

    /**
     *
     * @param message
     * @returns {*}
     */
    const sendForm = (message) => ses.send(getParams(message));

    return {
        sendForm: sendForm
    }

})(ses);

module.exports = formModule;