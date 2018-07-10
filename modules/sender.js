'use strict';

const ses = require('./ses');

const senderModule = (function (ses) {

    /**
     *
     * @param parameters
     * @returns {*}
     */
    const sendForm = (parameters) => ses.send(parameters);

    return {
        sendForm: sendForm
    }

})(ses);

module.exports = senderModule;