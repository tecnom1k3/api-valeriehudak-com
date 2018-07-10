'use strict';

const sender = require('./sender');
const templateTexts = require('./template');
const parameters = require('./parameters');

const formModule = (function (sender, templateTexts, parameters) {

    const toAddress = process.env.TO_ADDRESS;
    const fromAddress = process.env.FROM_ADDRESS;
    const subject = process.env.MAIL_SUBJECT;

    /**
     *
     * @param message
     * @returns {*}
     */
    const sendForm = function (message) {

        parameters.setFrom(fromAddress)
            .setTo(toAddress)
            .setSubject(subject)
            .setMessage(templateTexts.getTextTemplate({messageBody: message}));

        return sender.sendForm(parameters.getParams());
    };

    return {
        sendForm: sendForm
    }

})(sender, templateTexts, parameters);

module.exports = formModule;