<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MultiFile Test</title>
</head>

<body>
    <div class="MultiFile-wrap">
        <input type="file" multiple="multiple" id="upload_files" name="multifile-test[]">
        <div class="MultiFile-list" id="WithEvents_list"></div>
        <ul id="F9-Log"></ul>
    </div>

    <script src="../js/jquery.min.js" type="text/javascript"></script>


    <script>
        $(document).on("change", "#upload_files", async function(evt) {

            var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

            // FileReader support
            if (FileReader && files && files.length) {
                for (let x = 0; x < this.files.length; x++) {
                    //   var tgt = e.target || window.event.srcElement,
                    // files = tgt.files;


                    var fr = new FileReader();
                    fr.onload = function(e) {
                  
                        var img = document.createElement('img');
                        img.src = e.currentTarget.result;
                        img.style.width = "200px";
                        img.style.height = "auto";
                   

                        img.addEventListener("onclick", (event) => {
                            console.log(event)
                            Swal.fire(
                                <?= json_encode($login) ?>//event.target
                            )
                        })

                     


                        document.body.append(img);
                    }
                    fr.readAsDataURL(files[x]);
                }

            }

        });
    </script>
</body>

</html>