<!-- SCRIPT CHAIN DROPDOWNLIST RELATED -->
<script>           
    
    $(function(){                           
        $('#<?php echo $parentId;?>').change(function(){
            var parentId = $('#<?php echo $parentId;?>').val(); 
            var secondParentId = 0;
            var data = {'<?php echo $parentId;?>':parentId};
  
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
