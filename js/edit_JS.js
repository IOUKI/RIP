function check(type) {
    switch (type) {
        case 'update_member':
            let checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
            let price1 = document.getElementById('price1').value;
            let price2 = document.getElementById('price2').value;

            console.log(price1);
            console.log(price2);

            if (informationForm.name.value == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '店家名稱為必填，請勿留空！'
                });
            } else if (informationForm.phone.value == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '連絡電話為必填，請勿留空！'
                })
            } else if (informationForm.address.value == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '通訊地址為必填，請勿留空！'
                })
            } else if (informationForm.email.value == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '電子信箱為必填，請勿留空！'
                })
            } else if (checkboxes.length == 0) {
                Swal.fire({
                    icon: 'warning',
                    title: '服務宗教至少選一種！'
                })
            }else if(informationForm.price1.value != "" && informationForm.price2.value == "" || informationForm.price2.value != "" && informationForm.price1.value == "") {
                Swal.fire({
                    icon: 'warning',
                    title: '填寫價格範圍必須填寫完整最低和最高價！'
                })  
            }else if(isNaN(price1) || isNaN(price2)){
                Swal.fire({
                    icon: 'warning',
                    title: '價格必須填整數！'
                })
            }else {
                Swal.fire({
                    title: '確定更新?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '確定',
                    cancelButtonText: '取消'
                }).then((result) => {
                    if (result.isConfirmed) {
                        informationForm.submit();
                    }
                })
            }
            break;
        case 'update_introduction':
            Swal.fire({
                title: '確定更新?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確定',
                cancelButtonText: '取消'
            }).then((result) => {
                if (result.isConfirmed) {
                    introductionForm.submit();
                }
            })
            break;
        case 'add_picture':
            if (addimageForm.myfile.value == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '請選擇圖片檔案！'
                });
            } else if (addimageForm.imagename.value == '') {
                Swal.fire({
                    icon: 'warning',
                    title: '請輸入圖片名稱或敘述！'
                })
            } else {
                addimageForm.submit();
            }
            break;
        case 'update_service_item':
            Swal.fire({
                title: '確定更新?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確定',
                cancelButtonText: '取消'
            }).then((result) => {
                if (result.isConfirmed) {
                    service_itemForm.submit();
                }
            })
            break;
    }
}

function openStorePage(m_id) {
    window.open('./storePageCheck.php?page='+m_id, 'Store Page', config = 'height=1000,width=1000');
}