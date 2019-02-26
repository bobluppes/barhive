window.onload = function() {
    saveSetting = function(setting, checked) {
        Vue.http.post('/api/settings/set', {setting: setting, value: checked});
    }
}