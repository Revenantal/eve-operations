/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 179);
/******/ })
/************************************************************************/
/******/ ({

/***/ 179:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(180);


/***/ }),

/***/ 180:
/***/ (function(module, exports) {

$(function () {
    $('.localtime').each(function () {
        var strDate = $(this).data('date');
        var date = new Date(strDate + ' UTC');

        $(this).html(moment(date).format('YYYY-MM-DD[<br>]HH:mm:ss') + " " + moment().tz(Intl.DateTimeFormat().resolvedOptions().timeZone).format('z'));
    });

    $('.operation > .card-body > a').on('click', function () {
        $(this).parents('.operation').toggleClass("active");
    });

    $('.operation .edit-controls .button').on("click", function () {
        var action = $(this).data("action");
        var operationID = $(this).parents(".operation").data("operation-id");
        var operationName = $(this).parents(".operation").find(".operation-name").text();

        if (action == "delete") {
            modalDelete(operationID, operationName);
        }
    });

    function modalDelete(operationID, operationName) {
        var $modal = $('#deleteOperationModal');

        $modal.find('.op-name').text(operationName);
        $modal.find('form').attr("action", "/operations/" + operationID);

        $modal.modal('show');
    }
});

/***/ })

/******/ });