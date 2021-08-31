<li><a href="products.php?category=<?=$category['id']."&pageid_". md5(time());?>"><?=$category['category_name']?></a>
  <?php if($category['children']):?>
  <ul>
    <?php echo categories_to_string($category['children']) ?>
  </ul>
  <?php endif;?>
</li>