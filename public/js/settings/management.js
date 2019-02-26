window.onload = function() {
    saveSetting = function(setting, value) {
        Vue.http.post('/api/settings/set', {setting: setting, value: value});
    }
}