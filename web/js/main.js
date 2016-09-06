translit = (
    function() {
        var
            rus = "щ   ш  ч  ц  ю  я  ё  ж  ъ  ы  э  а б в г д е з и й к л м н о п р с т у ф х ь".split(/ +/g),
            eng = "shh sh ch cz yu ya yo zh `` y e a b v g d e z i y k l m n o p r s t u f x `".split(/ +/g);
        return function(text, engToRus) {
            var x;
            for(x = 0; x < rus.length; x++) {
                text = text.split(engToRus ? eng[x] : rus[x]).join(engToRus ? rus[x] : eng[x]);
                text = text.split(engToRus ? eng[x].toUpperCase() : rus[x].toUpperCase()).join(engToRus ? rus[x].toUpperCase() : eng[x].toUpperCase());
            }
            return text;
        }
    }
)();


$(document).ready(function () {

    $('#category-name').keyup(function(){
        var val = translit($(this).val()).replace(/ /g,'-');
        $('#category-category_slug').val(val);
    });

    // $('input[type="file"]').change( function(event) {
    //     var tmppath = URL.createObjectURL(event.target.files[0]);
    //     // alert(tmppath);
    //     $.post('/category/compare',{file_xml: tmppath},{data: 'multipart/form-data'},function(res){
    //             console.log(res)
    //         });
    //
    // });
    // $('select').select2();

});