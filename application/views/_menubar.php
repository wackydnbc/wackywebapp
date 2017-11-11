<?php
/*
 * Menu navbar, just an unordered list
 */
?>
<ul class="nav navbar-nav">
    {menudata}
    <li><a href="{link}">{name}</a></li>
    {/menudata}
</ul>
<ul class="nav navbar-nav">
      <li>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">User Role<b class="caret"></b></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                  <li><a href="/roles/actor/Guest">Guest</a></li>
                  <li><a href="/roles/actor/Owner">Owner</a></li>
        </ul>
      </li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li><a href="/about">About</a></li>
</ul>
