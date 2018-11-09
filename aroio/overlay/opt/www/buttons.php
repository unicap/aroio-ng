    <div class="content">
      <input class="button" type="submit" value=" <? print ${button_submit._.$lang} ?> " name="submit">
      <input class="button" type="submit" value=" <? print ${button_reboot._.$lang} ?> " name="reboot">
    </div>
  </form>

<? unset($_POST['submit']); ?>
<? include "footer.php"; ?>