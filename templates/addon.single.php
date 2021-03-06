<?php namespace Habari; ?>
<?php $theme->display('header'); ?>
<div id="involved" class="docpage <?php echo $post->info->type; ?>">
	<div class="container">
		<div class="row">
			<div id="theme" class="area four columns alpha">
				<a href="<?php echo URL::get("display_addons", array('addon' => 'theme')); ?>">
					<i class="icon-code">a</i>
					<p><strong>Themes</strong></p>
				</a>
			</div>
			<div id="plugin" class="area four columns">
				<a href="<?php echo URL::get("display_addons", array('addon' => 'plugin')); ?>">
					<i class="icon-code">P</i>
					<p><strong>Plugins</strong></p>
				</a>
			</div>
			<div id="bundle" class="area four columns">
				<a href="<?php echo URL::get("display_addons", array('addon' => 'bundle')); ?>">
					<i class="icon-code">b</i>
					<p><strong>Bundles</strong></p>
				</a>
			</div>
			<div id="core" class="area four columns omega">
				<a href="<?php echo URL::get("display_addons", array('addon' => 'core')); ?>">
					<i class="icon-code">C</i>
					<p><strong>Core</strong></p>
				</a>
			</div>
		</div>
	</div>
</div>
<div id="intro_header" class="docpage addon">
	<div class="container">
		<h3><?php echo $post->info->description; ?></h3>
	</div>
</div>
<div id="article" class="addon">
	<div class="container">
		<div id="edit_content" class="single">
			<div class="body columns eleven">
				<h2><?php echo $post->title_out; ?></h2>
				<?php echo $post->content_out; ?>
				<?php if( $post->info->instructions !== '' ) { ?>
					<?php echo $post->info->instructions; ?>
				<?php } ?>
				<?php if( $post->info->help !== '' ) { ?>
					<?php echo $post->info->help; ?>
				<?php } ?>
				<?php if ( $post->versions !== false ) { ?>
				<div class="downloads">					
					<hr>
					<h5>Available Versions</h5>
					<table id="addon_versions" width="100%">
						<thead>
							<tr>
								<th>Version</th>
								<th>Release Date</th>
								<th>Download Link</th>
								<?php if(count($permitted_versions) > 0): ?>
								<th>Manage</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
						<?php foreach ( $post->versions as $v ) { ?>
							<tr>
								<td><?php echo $v->term_display; ?></td>
								<td><?php echo DateTime::create( $v->info->release )->format( Options::get( "plugin_directory__date_format", "F j, Y" ) ); ?></td>
								<td><a href="<?php echo $v->download_url; ?>">Download <?php echo $v->info->version; ?></a></td>
								<?php if(count($permitted_versions) > 0): ?>
								<td>
								<?php if(in_array($v->term, $permitted_versions)): ?>
									<a href="<?php echo Site::get_url('habari') . '/remove_addon_version/' . $post->slug . '/' . $v->term; ?>">[<?php _e('Remove', 'addon_catalog'); ?>]</a>
								<?php endif; ?>
								</td>
								<?php endif; ?>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<?php } ?>
			</div>
			<div id="addon_sidebar" class="columns four offset-by-one">
			<?php if ( $post->versions !== false ) { ?>
				<div class="download four columns"><a href="<?php echo $post->versions[0]->download_url; ?>" title="download 1.0">Download <?php echo $post->versions[0]->info->version; ?></a></div>
				<div class="take_tour four columns"><a href="<?php URL::out('add_to_cart', array('slug' => $post->slug, 'version' => $post->version_slugify($post->versions[0]))); ?>" title="download 1.0">Add To Cart</a></div>
			<?php } ?>
				<div class="info">
					<ul>
						<li>
							<div style="float:left;margin-right: 5px;"><i class="icon-authors">V</i></div>
							<div style="float:left;width:185px;"><?php echo _n( " ", "", count( $post->info->authors ) ); ?> <?php echo AddonCatalogPlugin::name_url_list( $post->info->authors ); ?></div>
						</li>
						<li>
							<div style="float:left;margin-right: 5px;"><i class="icon-link">L</i></div>
							<div style="float:left;width:185px;"><a href="<?php echo $post->info->url; ?>">Developer Site</a></div>
						</li>
						<li>
							<div style="float:left;margin-right: 5px;"><i class="icon-link">g</i></div>
							<div style="float:left;width:185px;"><a href="<?php echo $post->info->repo_url; ?>"><?php echo ucfirst($post->info->type); ?> Repo</a></div>
						</li>
						<li>
							<div style="float:left;margin-right: 5px;"><i class="icon-license">l</i></div>
							<div style="float:left;width:185px;"><?php echo _n( " ", "", count( $post->info->licenses ) ); ?> <?php echo AddonCatalogPlugin::name_url_list( $post->info->licenses ); ?></div>
						</li>
						<?php if ( count( $post->tags ) > 0 ) { ?>
						<li>
							<div style="float:left;margin-right: 5px;"><i class="icon-tags">t</i></div>
							<div style="float:left;width:185px;">
								<?php 
									if ( count( $post->tags ) > 0 ) {
										echo _t( '%s', array( Format::tag_and_list( $post->tags, ', ', ', ' ) ) );
									}
								?>
							</div>
						</li>
						<?php } ?>
						<li>
							<?php echo $theme->area('plugin_sidebar'); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$('.execute a').click(function() {
		$('form:last').fadeToggle();
		return false;
	})
});
</script>
<div id="ending">
<?php $theme->display('footer'); ?>
