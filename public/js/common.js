/**
 * Created by Administrator on 2017-04-24.
 */
if (typeof(COMMON_JS) === 'undefined') {

    var COMMON_JS = true;

    $(document).on('click', '.btn-history-back', function() {
        history.back();
    });

    $(document).on('click', '.alertclose' , function() {
        $(this).closest('.alert').hide();
    });

    $(document).ready(function(){
        window.setTimeout(function() {
            $('.alert-auto-close').hide();
        }, 2500);
    });

    $(document).on('click', '#chkall', function() {
        var chk = document.getElementsByName('chk[]');
        for (i = 0; i < chk.length; i++)
            chk[i].checked = this.checked;
    });

    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: 'kr',
            autoclose: true,
            todayHighlight: true
        });
    });

    function trim(s) {
        var t = '';
        var from_pos = to_pos = 0;

        for (i = 0; i < s.length; i++) {
            if (s.charAt(i) === ' ') {
                continue;
            } else {
                from_pos = i;
                break;
            }
        }

        for (i = s.length; i >= 0; i--) {
            if (s.charAt(i-1) === ' ') {
                continue;
            } else {
                to_pos = i;
                break;
            }
        }
        t = s.substring(from_pos, to_pos);
        return t;
    }

    function select_submit(f, acttype, actpage) {
        var str = '';

        if ($("input[name='chk[]']:checked", f).length < 1) {
            alert('자료를 하나 이상 선택하세요.');
            return;
        }
        if (acttype === 'delete' && ! confirm('선택한 자료를 정말 삭제 하시겠습니까?')) return;
        if (acttype === 'recover' && ! confirm('선택한 자료를 정말 복원 하시겠습니까?')) return;
        if (acttype === 'trash' && ! confirm('선택한 자료를 정말 휴지통으로 이동하시겠습니까?')) return;

        f.action = actpage;
        f.submit();
    }

    function deletecheck(){
        if (confirm('정말 삭제하시겠습니까? 삭제하신 후에는 복구가 불가능합니다')) {
            return true;
        } else {
            return false;
        }
    }

    $(document).on('click', '.btn-list-update', function() {
        select_submit(document.flist, 'update', $(this).attr('data-list-update-url'));
    });

    $(document).on('click', '.btn-list-delete', function() {
        select_submit(document.flist, 'delete', $(this).attr('data-list-delete-url'));
    });

    $(document).on('click', '.btn-list-trash', function() {
        select_submit(document.flist, 'trash', $(this).attr('data-list-trash-url'));
    });

    $(document).on('click', '.btn-list-recover', function() {
        select_submit(document.flist, 'recover', $(this).attr('data-list-recover-url'));
    });

    $(document).on('click', '.btn-one-delete', function() {
        if (confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
            document.location.href= $(this).attr('data-one-delete-url');
            return true;
        } else {
            return false;
        }
    });

    $(document).on('click', '.btn-list-update-price', function() {
        if (confirm("상품 가격이 업데이트 됩니다. 정말 전송하시겠습니까?")) {
            document.flist.action = $(this).attr('data-list-update-url');
            document.flist.submit();
        } else {
            return false;
        }
    });


    $(document).on('click', '.btn-list-update-del', function() {
        if (confirm("삭제시 고도몰에 연동된 상품도 같이 삭제됩니다. 정말 삭제하시겠습니까?")) {
            document.flist.action = $(this).attr('data-list-update-url');
            document.flist.submit();
        } else {
            return false;
        }
    });


    $(document).on('click', '.btn-list-truncate', function() {
        if (confirm("휴지통 전체를 비웁니다.\n\n비운 자료는 절대 복구가 불가능합니다. \n\n그래도 진행하시겠습니까?")) {
            document.location.href= $(this).attr('data-list-truncate-url');
            return true;
        } else {
            return false;
        }
    });

    $(document).on('click', '.btn-one-recover', function() {
        if (confirm('선택한 자료를 정말 복원하시겠습니까?')) {
            document.location.href= $(this).attr('data-one-recover-url');
            return true;
        } else {
            return false;
        }
    });

    $(document).on('click', '.btn-one-trash', function() {
        if (confirm('선택한 자료를 정말 휴지통으로 이동하시겠습니까?')) {
            document.location.href= $(this).attr('data-one-trash-url');
            return true;
        } else {
            return false;
        }
    });

    $(document).on('click', '.list-chkbox, #chkall', function() {
        var $checkedCheckboxes = $('.list-chkbox:checked');
        var $checkboxes = $('.list-chkbox');
        if ($checkedCheckboxes.length) {
            $('.btn-list-update , .btn-list-selected').removeClass('disabled');
        } else {
            $('.btn-list-update , .btn-list-selected').addClass('disabled');
        }
    });

    $(document).on('click', '.view_full_image', function() {
        window.open( ci_url  + '/helptool/viewimage?imgurl=' + encodeURIComponent($(this).attr('data-origin-image-url')),
            'large_image', 'location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no');
        return false;
    });

    function makeSerializable(elem) {
        return $(elem).prop('elements', $('*', elem).andSelf().get());
    }
    // 쿠키 입력
    function set_cookie(name, value, expirehours, domain) {
        var today = new Date();
        today.setTime(today.getTime() + (60*60*1000*expirehours));
        document.cookie = cookie_prefix + name + '=' + escape( value) + '; path=/; expires=' + today.toGMTString() + ';';
        if (domain) {
            document.cookie += 'domain=' + domain + ';';
        }
    }

    // 쿠키 얻음
    function get_cookie(cookie_name) {
        var find_sw = false;
        var start, end;
        var i = 0;

        name = cookie_prefix + cookie_name

        for (i = 0; i <= document.cookie.length; i++) {
            start = i;
            end = start + name.length;

            if (document.cookie.substring(start, end) == name) {
                find_sw = true
                break
            }
        }

        if (find_sw === true) {
            start = end + 1;
            end = document.cookie.indexOf(';', start);

            if (end < start) {
                end = document.cookie.length;
            }

            return document.cookie.substring(start, end);
        }
        return '';
    }

    // 쿠키 지움
    function delete_cookie(name) {
        var today = new Date();

        today.setTime(today.getTime() - 1);
        var value = get_cookie(name);
        if (value) {
            document.cookie = cookie_prefix + name + '=' + value + '; path=/; expires=' + today.toGMTString();
        }
    }

    // 숫자에 , 를 출력
    function number_format(data) {

        var tmp = '';
        var number = '';
        var cutlen = 3;
        var comma = ',';
        var i;

        var sign = data.match(/^[\+\-]/);
        if (sign) {
            data = data.replace(/^[\+\-]/, '');
        }

        len = data.length;
        mod = (len % cutlen);
        k = cutlen - mod;
        for (i = 0; i < data.length; i++) {
            number = number + data.charAt(i);

            if (i < data.length - 1) {
                k++;
                if ((k % cutlen) === 0) {
                    number = number + comma;
                    k = 0;
                }
            }
        }

        if (sign !== null) {
            number = sign+number;
        }

        return number;
    }

    // 글자수 검사
    function check_byte(content, target) {
        var cont = $('#' + content).val();

        // 숫자를 출력
        $('#' + target).text(cont.length);

        return cont.length;
    }

    function resize_textarea(id,mode) {
        if (mode === 'down') {
            $('#' + id).height($('#' + id).height() + 50);
        } else if (mode === 'up') {
            $('#' + id).height($('#' + id).height() - 50);
        } else {
            $('#' + id).height(mode);
        }
    }

    /**
     * 우편번호 창
     **/
    var win_zip = function(frm_name, frm_zipcode, frm_address1, frm_address2, frm_address3, frm_address4) {
        if (typeof daum === 'undefined') {
            alert('다음 juso.js 파일이 로드되지 않았습니다.');
            return false;
        }

        var zip_case = 1;   //0이면 레이어, 1이면 페이지에 끼워 넣기, 2이면 새창

        var complete_fn = function(data){
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var fullAddr = ''; // 최종 주소 변수
            var extraAddr = ''; // 조합형 주소 변수

            // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                fullAddr = data.roadAddress;

            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                fullAddr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
            if (data.userSelectedType === 'R'){
                //법정동명이 있을 경우 추가한다.
                if (data.bname !== ''){
                    extraAddr += data.bname;
                }
                // 건물명이 있을 경우 추가한다.
                if (data.buildingName !== ''){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                extraAddr = (extraAddr !== '' ? ' (' + extraAddr + ')' : '');
            }

            // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
            var of = document[frm_name];

            of[frm_zipcode].value = data.zonecode;

            of[frm_address1].value = fullAddr;
            of[frm_address3].value = extraAddr;

            if (of[frm_address4] !== undefined){
                of[frm_address4].value = data.userSelectedType;
            }

            of[frm_address2].focus();
        };

        switch(zip_case) {
            case 1 :    //iframe을 이용하여 페이지에 끼워 넣기
                var daum_pape_id = 'daum_juso_page' + frm_zipcode,
                    element_wrap = document.getElementById(daum_pape_id),
                    currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
                if (element_wrap === null) {
                    element_wrap = document.createElement('div');
                    element_wrap.setAttribute('id', daum_pape_id);
                    element_wrap.style.cssText = 'display:none;border:1px solid;left:0;width:100%;height:300px;margin:5px 0;position:relative;-webkit-overflow-scrolling:touch;';
                    element_wrap.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-21px;z-index:1" class="close_daum_juso" alt="접기 버튼">';
                    jQuery('form[name="' + frm_name + '"]').find('input[name="' + frm_address1 + '"]').before(element_wrap);
                    jQuery('#' + daum_pape_id).off('click', '.close_daum_juso').on('click', '.close_daum_juso', function(e){
                        e.preventDefault();
                        jQuery(this).parent().hide();
                    });
                }

                new daum.Postcode({
                    oncomplete: function(data) {
                        complete_fn(data);
                        // iframe을 넣은 element를 안보이게 한다.
                        element_wrap.style.display = 'none';
                        // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                        document.body.scrollTop = currentScroll;
                    },
                    // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분.
                    // iframe을 넣은 element의 높이값을 조정한다.
                    onresize : function(size) {
                        element_wrap.style.height = size.height + 'px';
                    },
                    width : '100%',
                    height : '100%'
                }).embed(element_wrap);

                // iframe을 넣은 element를 보이게 한다.
                element_wrap.style.display = 'block';
                break;
            case 2 :    //새창으로 띄우기
                new daum.Postcode({
                    oncomplete: function(data) {
                        complete_fn(data);
                    }
                }).open();
                break;
            default :   //iframe을 이용하여 레이어 띄우기
                var rayer_id = 'daum_juso_rayer' + frm_zipcode,
                    element_layer = document.getElementById(rayer_id);
                if (element_layer === null) {
                    element_layer = document.createElement('div');
                    element_layer.setAttribute('id', rayer_id);
                    element_layer.style.cssText = 'display:none;border:5px solid;position:fixed;width:300px;height:460px;left:50%;margin-left:-155px;top:50%;margin-top:-235px;overflow:hidden;-webkit-overflow-scrolling:touch;z-index:10000';
                    element_layer.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" class="close_daum_juso" alt="닫기 버튼">';
                    document.body.appendChild(element_layer);
                    jQuery('#' + rayer_id).off('click', '.close_daum_juso').on('click', '.close_daum_juso', function(e){
                        e.preventDefault();
                        jQuery(this).parent().hide();
                    });
                }

                new daum.Postcode({
                    oncomplete: function(data) {
                        complete_fn(data);
                        // iframe을 넣은 element를 안보이게 한다.
                        element_layer.style.display = 'none';
                    },
                    width : '100%',
                    height : '100%'
                }).embed(element_layer);

                // iframe을 넣은 element를 보이게 한다.
                element_layer.style.display = 'block';
        }
    }
}