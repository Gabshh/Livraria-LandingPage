'use strict'

let state = false;

const toggle = () => {
    if(state){
        document.getElementById('senha-input').setAttribute('type', 'password');
        document.getElementById('olho-icon').style.color='#000';
        state = false;
    }else {
        document.getElementById('senha-input').setAttribute('type', 'text');
        document.getElementById('olho-icon').style.color='#1C5CF4';
        state = true;
    }
}