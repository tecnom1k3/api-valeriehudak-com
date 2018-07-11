'use strict';

const parametersModule = (function () {
    let _from;
    let _to;
    let _subject;
    let _txtMessage;
    let _htmlMessage;

    /**
     *
     * @param from
     * @returns {setFrom}
     */
    const setFrom = function (from) {
        _from = from;
        return this;
    };

    /**
     *
     * @param to
     * @returns {setTo}
     */
    const setTo = function (to) {
        _to = to;
        return this;
    };

    /**
     *
     * @param subject
     * @returns {setSubject}
     */
    const setSubject = function (subject) {
        _subject = subject;
        return this;
    };

    /**
     *
     * @param message
     * @returns {setTxtMessage}
     */
    const setTxtMessage = function (message) {
        _txtMessage = message;
        return this;
    };

    const setHtmlMessage = function (message) {
        _htmlMessage = message;
        return this;
    };

    /**
     *
     * @returns {{from: *, to: *, subject: *, message: *}}
     */
    const getParams = () => ({
        from: _from,
        to: _to,
        subject: _subject,
        message: _txtMessage,
        messageHtml: _htmlMessage
    });

    return {
        setFrom: setFrom,
        setTo: setTo,
        setSubject: setSubject,
        setTxtMessage: setTxtMessage,
        setHtmlMessage: setHtmlMessage,
        getParams: getParams
    };

})();

module.exports = parametersModule;