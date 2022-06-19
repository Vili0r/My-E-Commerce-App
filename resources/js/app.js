require('./bootstrap');

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import Choices from 'choices.js';

//Create multiselcet element

window.choices = (element) => {
    return new Choices(element, {
        maxItemCount: 5, 
        removeItemButton: true
    });
}
