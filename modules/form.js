'use strict';

const sender = require('./sender');

const formModule = (function (sender) {

    const toAddress = process.env.TO_ADDRESS;
    const fromAddress = process.env.FROM_ADDRESS;
    const subject = process.env.MAIL_SUBJECT;

    /**
     *
     * @param message
     * @returns {*}
     */
    const sendForm = (message) => sender.sendForm(toAddress, fromAddress, subject, message);

    return {
        sendForm: sendForm
    }

})(sender);

module.exports = formModule;