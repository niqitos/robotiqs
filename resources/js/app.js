/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Highlight = require('highlight.js');
// window.MediumEditorTables = require('medium-editor-tables');

Highlight.initHighlightingOnLoad();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('flash', require('./components/Flash.vue'));
// Vue.component('article-view', require('./pages/ArticleView.vue'));

Vue.prototype.authorize = function(handler) {
    let user = window.App.user;

    return user ? handler(user) : false;
};

Vue.prototype.optionsBodyToolbar = {
    buttons: [
        'bold',
        'italic',
        'underline',
        'anchor',
        'orderedlist',
        'unorderedlist',
        {
            name: 'pre',
            action: 'append-pre',
            aria: 'preformatted text',
            tagNames: ['pre'],
            contentDefault: '<b>0101</b>',
            contentFA: '<i class="fas fa-code fa-lg"></i>'
        },
        {
            name: 'image',
            action: 'image',
            aria: 'image',
            tagNames: ['img'],
            contentDefault: '<b>image</b>',
            contentFA: '<i class="far fa-image"></i>'
        },
        {
            name: 'h2',
            action: 'append-h2',
            aria: 'header 2',
            tagNames: ['h2'],
            contentDefault: '<b>H2</b>',
            contentFA: '<i class="fas fa-heading"></i><sup>2</sup>'
        },
        {
            name: 'h3',
            action: 'append-h3',
            aria: 'header 3',
            tagNames: ['h3'],
            contentDefault: '<b>H3</b>',
            contentFA: '<i class="fas fa-heading"></i><sup>3</sup>'
        },
        'quote'
    ],
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.events = new Vue();

window.flash = function(message) {
    window.events.$emit('flash', message);
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */      

const app = new Vue({
    el: '#app',
});


$('pre').append('<button class="copy"><i class="far fa-copy"></i></button>')

$(".copy").click(function(e){
    var $temp = $("<textarea>");
    $("body").append($temp);
    $temp.val($(this).siblings("code").text()).select();
    // $temp.val(101).select();
    document.execCommand("copy");
    $temp.remove();
});
