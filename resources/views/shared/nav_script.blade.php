<script>
  $('#details-tab').click(function(){
    window.location.href = '{{url("my")}}'
  })
  $('#topics-tab').click(function(){
    window.location.href = '{{url("my/topics")}}'
  })
  $('#orders-tab').click(function(){
    window.location.href = '{{url("my/orders")}}'
  })
  $('#products-tab').click(function(){
    window.location.href = '{{url("my/products")}}'
  })
</script>