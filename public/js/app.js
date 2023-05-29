// import IMask from 'imask';
// Отображение масок полей:
const mask = (dataValue, options) => { // создаем универсальную функцию
    const elements = document.querySelectorAll(`[data-mask="${dataValue}"]`) // ищем поля ввода по селектору с переданным значением data-атрибута
    if (!elements) return // если таких полей ввода нет, прерываем функцию

    elements.forEach(el => { // для каждого из полей ввода
        IMask(el, options) // инициализируем плагин imask для необходимых полей ввода с переданными параметрами маски
    })
};

// Маска для номера телефона
mask('phone', {
    mask: '+{7}(000) 000-00-00'
})
// Маска валюты
mask('currency', {
    mask: '₽ num',
    blocks: {
        num: {
            mask: Number,
            thousandsSeparator: ' ',
            // other options are optional with defaults below
            scale: 2,  // digits after point, 0 for integers
            signed: false,  // disallow negative
            padFractionalZeros: true,  // if true, then pads zeros at end to the length of scale
            normalizeZeros: false,  // appends or removes zeros at ends
            radix: '.',  // fractional delimiter
            mapToRadix: ['.', ','],  // symbols to process as radix

        }
    }
})
// Отображение и скрытие пароля
let showPasswordToggles = document.querySelectorAll("[type='password']");
showPasswordToggles.forEach((showPasswordToggle) => {
    if (showPasswordToggle) {
        showPasswordToggle.addEventListener("click", function () {
            document
                .querySelectorAll("[type='password']")
                .forEach((inputPassword) => {
                    inputPassword.classList.add("input-password");
                });
            document
                .querySelectorAll("#toggle-password")
                .forEach((togglePassw) => {
                    togglePassw.classList.remove("d-none");
                });
            const togglePasswordButtons = document.querySelector(
                ".show-hide__password"
            );

            togglePasswordButtons.addEventListener("click", (e) => {
                let target = e.target;
                if (target.className !== "toggle-password") return;
                let passwordInput =
                    target.closest(".form-floating").firstElementChild;
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            });
        });
    }
});
// Загрузка изображений
const avatar = document.querySelector(".lk-avatar");
const input_image = document.querySelector(".input-image");
const avatar_header = document.querySelector(".profile_photo");
const order__fields = document.querySelector(".order__fields");

const inputNewsImage = document.querySelector(".input-news-image");
const newsImage = document.querySelector(".input-news");
if(inputNewsImage) {
    function addImagePreview() {
        if (this.files && this.files.length) {
            const image = document.createElement('img');
            image.src = window.URL.createObjectURL(this.files[0]);
            image.classList.add('img-fluid', 'w-100', 'mb-3');
            newsImage.insertAdjacentElement('afterbegin', image);
        }
    }
    inputNewsImage.addEventListener("change", addImagePreview);
}

function lightDropZone(e) {
    e.preventDefault();
    let target = e.type;
    if (target === "dragover" || target === "dragover") {
        this.classList.add("drop__image");
    } else if (target === "dragleave") {
        this.classList.remove("drop__image");
    } else if (target === "drop") {
        loadImage.call(e.dataTransfer);
        console.log("done!");
    }
}
function loadImage() {
    console.log(this.files);
    if (this.files && this.files.length) {
        // avatar.src = window.URL.createObjectURL(this.files[0]);
        // avatar_header.src = window.URL.createObjectURL(this.files[0]);
    }
}
function updateImage() {
    console.log(this.files);
    if (this.files && this.files.length) {
        avatar.src = window.URL.createObjectURL(this.files[0]);
        avatar_header.src = window.URL.createObjectURL(this.files[0]);
    }
}
if (order__fields) {
    order__fields.addEventListener("dragover", lightDropZone);
    order__fields.addEventListener("dragenter", lightDropZone);
    order__fields.addEventListener("dragleave", lightDropZone);
    order__fields.addEventListener("drop", lightDropZone);
}
if (avatar && input_image) {
    input_image.addEventListener("change", updateImage);
}

// Реализация вкладок на главной странице
const elButtons = document.querySelectorAll(".tabs__btn");
const elPanes = document.querySelectorAll(".tabs__pane");
if (elButtons.length && elPanes.length) {
    class ItcTabs {
        constructor(target, config) {
            const defaultConfig = {};
            this._config = Object.assign(defaultConfig, config);
            this._elTabs =
                typeof target === "string"
                    ? document.querySelector(target)
                    : target;
            this._elButtons = this._elTabs.querySelectorAll(".tabs__btn");
            this._elPanes = this._elTabs.querySelectorAll(".tabs__pane");
            this._eventShow = new Event("tab.itc.change");
            this._init();
            this._events();
        }
        _init() {
            this._elTabs.setAttribute("role", "tablist");
            this._elButtons.forEach((el, index) => {
                el.dataset.index = index;
                el.setAttribute("role", "tab");
                this._elPanes[index].setAttribute("role", "tabpanel");
            });
        }
        show(elLinkTarget) {
            const elPaneTarget = this._elPanes[elLinkTarget.dataset.index];
            const elLinkActive =
                this._elTabs.querySelector(".tabs__btn_active");
            const elPaneShow = this._elTabs.querySelector(".tabs__pane_show");
            if (elLinkTarget === elLinkActive) {
                return;
            }
            elLinkActive
                ? elLinkActive.classList.remove("tabs__btn_active")
                : null;
            elPaneShow ? elPaneShow.classList.remove("tabs__pane_show") : null;
            elLinkTarget.classList.add("tabs__btn_active");
            elPaneTarget.classList.add("tabs__pane_show");
            this._elTabs.dispatchEvent(this._eventShow);
            elLinkTarget.focus();
        }
        showByIndex(index) {
            const elLinkTarget = this._elButtons[index];
            elLinkTarget ? this.show(elLinkTarget) : null;
        }
        _events() {
            this._elTabs.addEventListener("click", (e) => {
                const target = e.target.closest(".tabs__btn");
                if (target) {
                    e.preventDefault();
                    this.show(target);
                }
            });
        }
    }
    new ItcTabs(".tabs");
}
// Отображение и удаление картинок
var dt = new DataTransfer();

$(".input-file-order input[type=file]").on("change", function () {
    let $files_list = $(this).closest(".input-file-order").next();
    $files_list.empty();
    for (var i = 0; i < this.files.length; i++) {
        let file = this.files.item(i);
        dt.items.add(file);

        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = function () {
            let new_file_input =
                '<div class="input-file-list-item">' +
                '<img class="input-file-list-img object-fit-scale bg-white" src="' +
                reader.result +
                '" alt="' +
                file.name +
                '">' +
                '<a href="#" onclick="removeFilesItem(this); return false;" class="input-file-list-remove"><i class="fa-solid fa-xmark"></i></a>' +
                "</div>";
            $files_list.append(new_file_input);
        };
    }
    this.files = dt.files;
});

function removeFilesItem(target) {
    let name = $(target).prev().attr("alt");
    let input = $(target).closest(".order-file").find("input[type=file]");
    $(target).closest(".input-file-list-item").remove();
    for (let i = 0; i < dt.items.length; i++) {
        if (name === dt.items[i].getAsFile().name) {
            dt.items.remove(i);
        }
    }
    input.files = dt.files;
}

//Анимация изображений
const svgStoriesDestination = document.querySelector(
    ".svg-stories-destination"
);
if (svgStoriesDestination) {
    svgStoriesDestination.classList.remove("animated");

    const observerStoriesDestination = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                svgStoriesDestination.classList.add("animated");
                return;
            }
            svgStoriesDestination.classList.remove("animated");
        });
    });
    observerStoriesDestination.observe(
        document.querySelector(".animation-square-stories-destination")
    );
}

const svgSquareStoriesOnlineWorld = document.querySelector(
    ".svg-stories-online-world"
);
if (svgSquareStoriesOnlineWorld) {
    svgSquareStoriesOnlineWorld.classList.remove("animated");

    const observerStoriesOnlineWorld = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                svgSquareStoriesOnlineWorld.classList.add("animated");
                return;
            }
            svgSquareStoriesOnlineWorld.classList.remove("animated");
        });
    });
    observerStoriesOnlineWorld.observe(
        document.querySelector(".animation-square-stories-online-world")
    );
}

// Автоизменение высоты textarea
(function (global, factory) {
    typeof exports === "object" && typeof module !== "undefined"
        ? (module.exports = factory())
        : typeof define === "function" && define.amd
        ? define(factory)
        : ((global = global || self), (global.autosize = factory()));
})(this, function () {
    var map =
        typeof Map === "function"
            ? new Map()
            : (function () {
                  var keys = [];
                  var values = [];
                  return {
                      has: function has(key) {
                          return keys.indexOf(key) > -1;
                      },
                      get: function get(key) {
                          return values[keys.indexOf(key)];
                      },
                      set: function set(key, value) {
                          if (keys.indexOf(key) === -1) {
                              keys.push(key);
                              values.push(value);
                          }
                      },
                      delete: function _delete(key) {
                          var index = keys.indexOf(key);

                          if (index > -1) {
                              keys.splice(index, 1);
                              values.splice(index, 1);
                          }
                      },
                  };
              })();

    var createEvent = function createEvent(name) {
        return new Event(name, {
            bubbles: true,
        });
    };

    try {
        new Event("test");
    } catch (e) {
        createEvent = function createEvent(name) {
            let evt = document.createEvent("Event");
            evt.initEvent(name, true, false);
            return evt;
        };
    }

    function assign(ta) {
        if (!ta || !ta.nodeName || ta.nodeName !== "TEXTAREA" || map.has(ta))
            return;
        var heightOffset = null;
        var clientWidth = null;
        var cachedHeight = null;
        function init() {
            var style = window.getComputedStyle(ta, null);

            if (style.resize === "vertical") {
                ta.style.resize = "none";
            } else if (style.resize === "both") {
                ta.style.resize = "horizontal";
            }

            if (style.boxSizing === "content-box") {
                heightOffset = -(
                    parseFloat(style.paddingTop) +
                    parseFloat(style.paddingBottom)
                );
            } else {
                heightOffset =
                    parseFloat(style.borderTopWidth) +
                    parseFloat(style.borderBottomWidth);
            }

            if (isNaN(heightOffset)) {
                heightOffset = 0;
            }

            update();
        }

        function changeOverflow(value) {
            {
                let width = ta.style.width;
                ta.style.width = "0px";
                ta.style.width = width;
            }
            ta.style.overflowY = value;
        }

        function bookmarkOverflows(el) {
            var arr = [];

            while (el && el.parentNode && el.parentNode instanceof Element) {
                if (el.parentNode.scrollTop) {
                    el.parentNode.style.scrollBehavior = "auto";
                    arr.push([el.parentNode, el.parentNode.scrollTop]);
                }

                el = el.parentNode;
            }

            return function () {
                return arr.forEach(function (_ref) {
                    let node = _ref[0];
                    // let scrollTop = _ref[1];
                    node.scrollTop = _ref[1];
                    node.style.scrollBehavior = null;
                });
            };
        }

        function resize() {
            if (ta.scrollHeight === 0) {
                return;
            }

            var restoreOverflows = bookmarkOverflows(ta);
            ta.style.height = "";
            ta.style.height = ta.scrollHeight + heightOffset + "px";

            clientWidth = ta.clientWidth;
            restoreOverflows();
        }

        function update() {
            resize();
            var styleHeight = Math.round(parseFloat(ta.style.height));
            var computed = window.getComputedStyle(ta, null);

            var actualHeight =
                computed.boxSizing === "content-box"
                    ? Math.round(parseFloat(computed.height))
                    : ta.offsetHeight;

            if (actualHeight < styleHeight) {
                if (computed.overflowY === "hidden") {
                    changeOverflow("scroll");
                    resize();
                    actualHeight =
                        computed.boxSizing === "content-box"
                            ? Math.round(
                                  parseFloat(
                                      window.getComputedStyle(ta, null).height
                                  )
                              )
                            : ta.offsetHeight;
                }
            } else {
                if (computed.overflowY !== "hidden") {
                    changeOverflow("hidden");
                    resize();
                    actualHeight =
                        computed.boxSizing === "content-box"
                            ? Math.round(
                                  parseFloat(
                                      window.getComputedStyle(ta, null).height
                                  )
                              )
                            : ta.offsetHeight;
                }
            }

            if (cachedHeight !== actualHeight) {
                cachedHeight = actualHeight;
                var evt = createEvent("autosize:resized");

                try {
                    ta.dispatchEvent(evt);
                } catch (err) {

                }
            }
        }

        var pageResize = function pageResize() {
            if (ta.clientWidth !== clientWidth) {
                update();
            }
        };

        var destroy = function (style) {
            window.removeEventListener("resize", pageResize, false);
            ta.removeEventListener("input", update, false);
            ta.removeEventListener("keyup", update, false);
            ta.removeEventListener("autosize:destroy", destroy, false);
            ta.removeEventListener("autosize:update", update, false);
            Object.keys(style).forEach(function (key) {
                ta.style[key] = style[key];
            });
            map["delete"](ta);
        }.bind(ta, {
            height: ta.style.height,
            resize: ta.style.resize,
            overflowY: ta.style.overflowY,
            overflowX: ta.style.overflowX,
            wordWrap: ta.style.wordWrap,
        });

        ta.addEventListener("autosize:destroy", destroy, false);

        if ("onpropertychange" in ta && "oninput" in ta) {
            ta.addEventListener("keyup", update, false);
        }

        window.addEventListener("resize", pageResize, false);
        ta.addEventListener("input", update, false);
        ta.addEventListener("autosize:update", update, false);
        ta.style.overflowX = "hidden";
        ta.style.wordWrap = "break-word";
        map.set(ta, {
            destroy: destroy,
            update: update,
        });
        init();
    }

    function destroy(ta) {
        var methods = map.get(ta);

        if (methods) {
            methods.destroy();
        }
    }

    function update(ta) {
        var methods = map.get(ta);

        if (methods) {
            methods.update();
        }
    }

    var autosize = null; // Do nothing in Node.js environment and IE8 (or lower)

    if (
        typeof window === "undefined" ||
        typeof window.getComputedStyle !== "function"
    ) {
        autosize = function autosize(el) {
            return el;
        };

        autosize.destroy = function (el) {
            return el;
        };

        autosize.update = function (el) {
            return el;
        };
    } else {
        autosize = function autosize(el, options) {
            if (el) {
                Array.prototype.forEach.call(
                    el.length ? el : [el],
                    function (x) {
                        return assign(x);
                    }
                );
            }

            return el;
        };

        autosize.destroy = function (el) {
            if (el) {
                Array.prototype.forEach.call(el.length ? el : [el], destroy);
            }

            return el;
        };

        autosize.update = function (el) {
            if (el) {
                Array.prototype.forEach.call(el.length ? el : [el], update);
            }
            return el;
        };
    }
    var autosize$1 = autosize;
    return autosize$1;
});
autosize(document.querySelectorAll("textarea"));

// Подсчёт количества символов в поле "О себе" и "Сообщение":;
let aboutMe = document.querySelector(".about_me");
let aboutMeMessage = document.querySelector(".about_me_message");
if (aboutMe && aboutMeMessage) {
    let text_max = 400;
    aboutMe.addEventListener("keyup", () => {
        if (!aboutMe.value.length) {
            aboutMeMessage.innerText = "Расскажите о себе в 400 символах.";
        } else {
            let textRemaining = text_max - aboutMe.value.length;
            aboutMeMessage.innerText = `Осталось ${textRemaining} символов.`;
        }
    });
}
let offerWithMessage = document.querySelector(".offer_with_message");
let offerMessage = document.querySelector(".offer_message");
if (offerWithMessage && offerMessage) {
    let text_max = 400;
    offerMessage.addEventListener("keyup", () => {
        if (!offerMessage.value.length) {
            offerWithMessage.innerText = "Расскажите о себе в 400 символах.";
        } else {
            let textRemaining = text_max - offerMessage.value.length;
            offerWithMessage.innerText = `Осталось ${textRemaining} символов.`;
        }
    });
}
