require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import '@github/markdown-toolbar-element';
import tippy from 'tippy.js';

tippy('[data-tippy-content]');
