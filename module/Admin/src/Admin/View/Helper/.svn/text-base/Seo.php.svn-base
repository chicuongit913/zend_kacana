<?php
namespace Admin\view\Helper;

use Zend\View\Helper\AbstractHelper;

class Seo extends AbstractHelper
{
    protected $_form;
    
    protected $_seo;
    
    
    public function editFormSeo($form)
    {
        $this->_form = $form;
        return $this;
    }
    public function editSeo()
    {
    	$this->_seo=
    '	<div id="bloc_seo" class="bloc_in_form">
			<span class="bloc_title expand_close"> SEO </span>
			<div style="display: none;" class="bloc_content">
		    	<div class="form-item">			
					<div class="top">
						<a id="multi_expand_aliases" class="multi_language_expand closed">&nbsp;</a>
						<span class="label">Alias</span>
					</div>
					<div id="aliases" class="field-wrapper">				
						<div id="zone_alias_vi" class="zone default">
							'. $this->_form->aliasVi.'			
						</div>
						<div id="zone_alias_en" class="zone" style="display:none;">
							'. $this->_form->aliasEn.'			
						</div>'.
// 						<div id="zone_alias_ja" class="zone" style="display:none;">
// 							'. $this->_form->aliasJa.'			
// 						</div>			
// 						<div id="zone_alias_zh" class="zone" style="display:none;">
// 							'. $this->_form->aliasZh.'			
// 						</div>			
						'<div id="zone_alias_fr" class="zone" style="display:none;">
							'. $this->_form->aliasFr.'			
						</div>			
					</div>
					<div class="clear"></div>
				</div>
					
				<div class="form-item">
					<div class="top">
						<a id="multi_expand_metatags" class="multi_language_expand closed">&nbsp;</a>
						<span class="label">Metatags</span>
					</div>			
					<div id="metatags" class="field-wrapper">				
						<div id="zone_metatag_vi" class="zone default">
							'. $this->_form->metatagVi.'			
						</div>
						<div id="zone_metatag_en" class="zone" style="display:none;">
							'. $this->_form->metatagEn.'			
						</div>'.
// 						<div id="zone_metatag_ja" class="zone" style="display:none;">
// 							'. $this->_form->metatagJa.'			
// 						</div>			
// 						<div id="zone_metatag_zh" class="zone" style="display:none;">
// 							'. $this->_form->metatagZh.'			
// 						</div>			
						'<div id="zone_metatag_fr" class="zone" style="display:none;">
							'. $this->_form->metatagFr.'			
						</div>			
					</div>
					<div class="clear"></div>
				</div>
					
				<div class="form-item">
					<div class="top">
						<a id="multi_expand_keywords" class="multi_language_expand closed">&nbsp;</a>
						<span class="label">Keywords</span>
					</div>			
					<div id="keywords" class="field-wrapper">
						
						<div id="zone_keyword_vi" class="zone default">
							'. $this->_form->keywordVi.'			
						</div>
						<div id="zone_keyword_en" class="zone" style="display:none;">
							'. $this->_form->keywordEn.'			
						</div>'.
// 						<div id="zone_keyword_ja" class="zone" style="display:none;">
// 							'. $this->_form->keywordJa.'			
// 						</div>			
// 						<div id="zone_keyword_zh" class="zone" style="display:none;">
// 							'. $this->_form->keywordZh.'			
// 						</div>			
						'<div id="zone_keyword_fr" class="zone" style="display:none;">
							'. $this->_form->keywordFr.'			
						</div>			
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>';
    	
    	return $this;
    }
    
    public function toString()
    {
    	return $this->_seo;
    }

}
?>