<span href="#" class="button" id="toggle-login">Log in</span>

<div id="login">
	<div id="triangle"></div>
	<h1>Log in</h1>
  <?php echo $this->Form->create('User', array('url' => array('controller' => 'home', 'action' => 'login'), 'id'=>'frm_login'));?>
    <input type="email" name="data[User][email]"
		placeholder="Please enter email" /> <input type="password"
		name="data[User][password]" placeholder="Please enter password" /> <input
		type="submit" value="Log in" />
	</form>
</div>
<script
	src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
