```javascript
var key = CryptoJS.enc.Utf8.parse('16位key')
var iv  = CryptoJS.enc.Utf8.parse(CryptoJS.lib.WordArray.random(8))
var encrypted = CryptoJS.AES.encrypt(
    "排序后的参数字符串",
    key,
    {
        iv : iv,
        mode : CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    }
);

```