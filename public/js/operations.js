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
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

$(function () {

    populateDates();

    $('.date select').change(function () {

        var days = $('.date select.day').val();
        var hours = $('.date select.hour').val();
        var minutes = $('.date select.minute').val();

        if (days && hours && minutes) {
            var opDate = new Date();
            opDate.setDate(opDate.getUTCDate() + Number(days));
            opDate.setHours(opDate.getUTCHours() + Number(hours));
            opDate.setMinutes(opDate.getUTCMinutes() + Number(minutes));

            document.querySelector(".flatpickr")._flatpickr.setDate(opDate);
            console.log(opDate);
        }
    });

    $(".flatpickr").flatpickr({
        enableTime: true,
        minDate: "today",
        time_24hr: true
    });

    $("#operation_type").change(function () {
        $detailPanel = $("#detail-panel");
        $('#operation-details').fadeOut('fast');
        $.get("/operations/parts/" + this.value, function (data) {
            $detailPanel.html(data);
        }).done(function (data) {
            $("#operation-details .flatpickr").flatpickr({
                enableTime: true,
                minDate: "today",
                time_24hr: true
            });
            $('#operation-details').slideDown('fast');
        });
    });

    if ($('#operation_type').find(":selected").val()) {
        $opType = $('#operation_type').find(":selected").val();
        $.get("/operations/parts/" + $opType, function (data) {
            $('#operation-details').fadeOut('fast');
            $('#detail-panel').html(data);
        }).done(function (data) {
            $("#operation-details .flatpickr").flatpickr({
                enableTime: true,
                minDate: "today",
                time_24hr: true
            });
            $('#operation-details').slideDown('fast');
        });
    }

    // Validate if user exists
    $('.username').focusout(function () {
        var username = $(this).val().trim();
        getCharactersByUsername(username);
    });

    $(document).on('click', '.setCharacter', function () {
        var character_id = $(this).data('character_id');
        var character_name = $(this).data('character_name');
        setCharacter(character_id, character_name);
        $('#characterSelector').modal('hide');
    });

    function getCharactersByUsername(username) {
        if (username.length >= 3) {
            $.ajax({
                url: "https://esi.tech.ccp.is/latest/search/?categories=character&search=" + encodeURIComponent(username)
            }).done(function (data) {
                if (!data.character) {
                    setCharacter();
                } else if (data.character.length == 1) {
                    setCharacter(data.character[0], username);
                } else if (data.character.length > 20) {
                    displayCharacterListModal(data.character.slice(0, 20));
                } else if (data.character.length > 0) {
                    displayCharacterListModal(data.character);
                }
            });
        } else {
            setCharacter();
        }
    }

    function displayCharacterListModal(character_ids) {
        var $modal = $('#characterSelector');
        var $modalBody = $modal.find('.modal-body #character-selector');
        $modalBody.html('');

        $.ajax({
            url: "https://esi.tech.ccp.is/latest/characters/names/?character_ids=" + character_ids.join(",")
        }).done(function (data) {
            if (!data.error) {
                data.forEach(function (character) {
                    $.ajax({
                        url: "https://esi.tech.ccp.is/latest/characters/" + character.character_id + "/portrait/"
                    }).done(function (data) {
                        var portrait = '/images/no-fc.png';
                        if (!data.error) {
                            var portrait = data.px256x256;
                        }
                        $modalBody.append(' \
                        <div class="col-lg-3 col-md-4 col-6 setCharacter mb-3" data-character_id="' + character.character_id + '" data-character_name="' + character.character_name + '"> \
                            <div class="card"> \
                                <img class="card-img-top" src="' + portrait + '" alt="' + character.character_name + '"> \
                                <div class="card-footer"> \
                                    <p class="card-text text-center">' + character.character_name + '</p> \
                                </div> \
                            </div> \
                        </div>');
                    });
                });
            }
            $modal.modal();
        });
    }

    function setCharacter(id, name) {

        if (id) {
            $('#organizer-portrait').hide();
            $('#character-loading').show();
            $.ajax({
                url: "https://esi.tech.ccp.is/latest/characters/" + id + "/portrait/"
            }).done(function (data) {
                if (!data.error) {
                    $('#assigned_to').val(id);
                    $('#organizer-name').val(name);
                    $('#organizer-portrait').attr('src', data.px64x64);
                }
            });
        } else {
            $('#assigned_to').val('');
            $('#organizer-name').val('');
            $('#organizer-portrait').attr('src', '/images/no-fc.png');
        }

        $('#organizer-portrait').on('load', function () {
            $('#character-loading').hide();
            $('#organizer-portrait').show();
        });
    }

    function populateDates() {
        $daySelect = $('select.day');
        $hourSelect = $('select.hour');
        $minuteSelect = $('select.minute');

        var i = 0;
        while (i <= 59) {

            if (i <= 23) {
                $hourSelect.append($('<option>', { value: i, text: i }));
            }

            if (i <= 31) {
                $daySelect.append($('<option>', { value: i, text: i }));
            }

            $minuteSelect.append($('<option>', { value: i, text: i }));
            i++;
        }
    }
});

/***/ })

/******/ });