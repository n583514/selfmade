$(function () {
    var favorite = $('.js-favorite-toggle');
    var favoritePostId;
    
    favorite.on('click', function () {
        var $this = $(this);
        console.log($this);
        favoritePostId = $this.data('reviewid');
        console.log(favoritePostId);
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/like',  //routeの記述
                type: 'POST', //受け取り方法の記述（GETもある）
                dataType: 'json',
                data: {
                    'id': favoritePostId, //コントローラーに渡すパラメーター
                },
        })
        
    
            // Ajaxリクエストが成功した場合
            ////コントローラーからのリターンされた値をdataとして指定
            .done(function (data) {
                console.log('success');
                console.log('data');
    //lovedクラスを追加
                $this.toggleClass('loved'); 
    
    //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
                $this.next('.favoritesCount').html(data.postfavoritesCount); 
    
            })
            // Ajaxリクエストが失敗した場合
            .fail(function (XMLHttpRequest, textStatus, errorThrown) {
               
               console.log('error');
               console.log(XMLHttpRequest.status);
               console.log(textStatus);
               console.log(errorThrown);
            });
        
        return false;
    });
    });