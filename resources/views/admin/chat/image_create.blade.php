<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdnjs.loli.net/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.loli.net/ajax/libs/layui/2.7.6/css/layui.css" />
</head>

<body class="bg-secondary">
<div class="container mx-auto text-center px-5 pt-3 pb-2 shadow mt-5 bg-white rounded"
     style="width:800px;max-width: 90%">
    <h3 class="mb-3">🍃 填写您的关键词 🍃</h3>
    <h5 class="mb-3">点击获取图片后需要时间，需耐心等待图片生成</h5>
    <div class="mb-3">
        <input type="text" class="form-control border border-primary-subtle border-5 " id="idwords"
               placeholder="描述 例如:奥特曼在月球上骑马" maxlength="1000"/>
    </div>
    <div class="input-group mb-3">
        <select class="form-select" id="idsize">
            <option value="256x256">小图256x256</option>
            <option value="512x512">中等512x512</option>
            <option value="1024x1024">大图1024x1024</option>
        </select>
        <select class="form-select" id="idnum">
            <option value="1">生成1张图片</option>
            <option value="2">生成2张图片</option>
            <option value="3">生成3张图片</option>
            <option value="4">生成4张图片</option>
            <option value="5">生成5张图片</option>
            <option value="6">生成6张图片</option>
            <option value="7">生成7张图片</option>
            <option value="8">生成8张图片</option>
            <option value="9">生成9张图片</option>
            <option value="10">生成10张图片</option>
        </select>
        <input type="hidden" name="request_uid" value="{{Admin::user()->id}}"  id="request_uid">
    </div>
    <div class="mb-3">
        <button class="btn btn-success btn-lg btn-create">获取图片</button>
    </div>

    <div class="py-2">
        <span class="loading"></span>
        <div class="contents pt-2 row"></div>
    </div>
</div>
<script src="https://cdnjs.loli.net/ajax/libs/layui/2.7.6/layui.js"></script>
<script src="https://cdnjs.loli.net/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.loli.net/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(() => {
        $('.btn-create').click(() => {
            layer.load(2);
            let words = $('#idwords').val();
            let size = $('#idsize').val();
            let idNum = $('#idnum').val();
            let requestUid = $('#request_uid').val();
            let contents = $(".contents");
            if (words == '') {
                layer.alert('请输入您的关键词用以生成图片', function () {
                    layer.closeAll();
                });
                return ;
            }

            let formData = `prompt=${words}&n=${idNum}&size=${size}&request_uid=${requestUid}`;
            $('.loading').addClass('fst-italic').html('正在生成, 不要重复点击以免错过好的图片，请耐心等待...');
            contents.html('');
            $.ajax({
                url: "/admin/chatgpt/image-create-process",
                type: "POST",
                data: formData,
                dataType: 'json',

                success: (response) => {
                    if (response['msg']['error']) {
                        layer.alert(response['msg']['error']['message']);return ;
                    }
                    let images = response['data'];
                    for (let i = 0; i < images.length; i++) {
                        let url = images[i].b64_json;
                        let img = 'data:image/png;base64,' + url;
                        let image = `<div class='col-3 px-3 py-3'><ll onclick="{
            let imgSrc = $(this).attr('src');
            const img = new window.Image();
            img.src = imgSrc;
            const newWin = window.open('');
            newWin.document.body.style.background = '#000';
            newWin.document.body.style.textAlign = 'center';
            newWin.document.body.appendChild(img);
            newWin.document.title = '图片预览';
            newWin.document.close();
        }" src="${img}"><img src="${img}" class='rounded border border-1 shadow w-100'/></ll></div>`;
                        contents.append(image);
                    }
                    $('.loading').remove('fst-italic').html(`关键字的结果 <b>${words}</b>,如需看大图请左键点击图片，如需保存请右击图片保存至本地~`);
                    layer.closeAll();
                },
                error:(response) => {
                    layer.alert(response['msg'], function () {
                        layer.closeAll();
                    });

                },
            });
        });
    });
</script>
</body>

</html>
