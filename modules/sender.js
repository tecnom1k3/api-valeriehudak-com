'use strict';

const ses = require('./ses');

const senderModule = (function (ses) {

    /**
     *
     * @param to
     * @param from
     * @param subject
     * @param body
     * @returns {*}
     */
    const sendForm = (to, from, subject, body) => ses.send(from, to, subject, body);

    return {
        sendForm: sendForm
    }

})(ses);

module.exports = senderModule;