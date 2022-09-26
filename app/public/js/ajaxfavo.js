$(function () {
    //var favorite = $('.js-favorite-toggle');
    //var favoritePostId;
    
    $('.js-favorite-toggle').on('click', function () {
        var $this = $(this);
        post_id = $this.data('post_id');
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/like',  //routeの記述
                type: 'POST', //受け取り方法の記述（GETもある）
                dataType: 'json',
                data: {
                    'post_id': post_id, //コントローラーに渡すパラメーター
                },
        })
    
            // Ajaxリクエストが成功した場合
            ////コントローラーからのリターンされた値をdataとして指定
            .done(function (data) {
                alert('成功？');
    //lovedクラスを追加
                $this.toggleClass('loved'); 
    
    //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
                $this.next('.favoritesCount').html(data.postfavoritesCount); 
    
            })
            // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
    //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
    //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
               alert('いいね処理失敗');
               alert(xhr);
               alert(err);
               alert(data);
            });
        
        return false;
    });
    });