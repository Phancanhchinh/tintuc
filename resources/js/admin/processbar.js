import Vue from 'vue'
import VueProgressBar from 'vue-progressbar'

const options = {
    color: '#02ED78',
    failedColor: '#FB0408',
    thickness: '4px',
    transition: {
    speed: '4s',
    opacity: '0.6s',
    termination: 4000
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}

Vue.use(VueProgressBar, options)

export default {VueProgressBar, options}
