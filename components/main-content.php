<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <button class="btn btn-lg" onclick="goBack()"><i class="fas fa-angle-left"></i></button>
            <h1 class="head"><?= $head ?></h1>
            <hr style="margin-top: -3px;">
        </div>
<script>
    function goBack() {
        window.history.back();
    }
</script>

