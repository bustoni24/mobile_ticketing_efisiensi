<!-- SCRIPT CHAIN DROPDOWNLIST RELATED -->
<script>           
    
    $(function(){        
        $("body").on('change', '#<?php echo $parentId;?>', function(){                   
        // $('#<?php echo $parentId;?>').change(function(){
            var parentId = $('#<?php echo $parentId;?>').val();
            var secondParentId = 0;
            if (typeof <?php echo $secondParentId;?> !== "undefined" && <?php echo $secondParentId;?> !== null && <?php echo $secondParentId;?> !== ""){
                secondParentId = $('#<?php echo $secondParentId;?>').val();
            }
            
            var data = {'<?php echo $parentId;?>':parentId, '<?php echo $secondParentId;?>':secondParentId};
  
        $("#<?php echo $childId;?> > option").remove();
            
        $.ajax({
            /*url:"<?php echo Yii::app()->createAbsoluteUrl($url); ?>",*/
            url:"<?php echo Constant::baseUrl() . '/'. $url; ?>",
            data:data,
            type:'post',
            dataType:'json',
            success:function(data){
                $.each(data,function(<?php echo $valueField;?>,<?php echo $textField;?>) 
                {
                    var opt = $('<option />');
                    opt.val(<?php echo $valueField;?>);
                    opt.text(<?php echo $textField;?>);
                    $('#<?php echo $childId;?>').append(opt);                                        
                });

            }
        })
        })
    })
</script>
