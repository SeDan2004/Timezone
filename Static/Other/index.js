
function CheckTags()
{
  $.ajax({
    method: "POST",
    url: '/PHP_Scripts/CheckTags.php',
    success: function (arg)
    {
      console.log(arg);
    }
  })
}

CheckTags();