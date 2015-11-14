Hello Announce Administrator,

<?php if (count($expiring)){ ?>
The following <?php echo count($expiring); ?> articles will expire within 3 days:
<?php
foreach ($expiring as $node){
  echo $node->title."\n";
}
}
?>
<?php if (count($expired)){ ?>
The following <?php echo count($expired); ?> articles have already expired and weren't sent yet:
<?php
foreach ($expired as $node){
  echo $node->title."\n";
}
$message = "Please make sure you send the Announce as soon as possible, you are now over deadline!\n\n";
}
?>
<?php if (count($unpublished)){ ?>
The following <?php echo count($unpublished); ?> articles have reached their expiry date, and have been sent, they have now been archived:
<?php
foreach ($unpublished as $node){
  echo $node->title."\n";
}
}
?>

<?php
  if (isset($message)) echo $message;
?>

Regards,
The AMIV Announce expiry bot.
