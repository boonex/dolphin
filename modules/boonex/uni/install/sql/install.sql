SET @sName = 'bx_uni';


-- SETTINGS
INSERT INTO `sys_options_types`(`group`, `name`, `caption`, `icon`, `order`) VALUES 
('templates', @sName, '_bx_uni_stg_cpt_type', 'bx_uni@modules/boonex/uni/|std-mi.png', 2);
SET @iTypeId = LAST_INSERT_ID();

-- SETTINGS: UNI System
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_system'), '_bx_uni_stg_cpt_category_system', 1);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_switcher_title'), '_bx_uni_stg_cpt_option_switcher_name', 'UNI', 'digit', '', '', '', 1);

-- SETTINGS: UNI Styles Header
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_styles_header'), '_bx_uni_stg_cpt_category_styles_header', 2);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_header_bg_color'), '_bx_uni_stg_cpt_option_header_bg_color', 'rgba(59, 134, 134, 1)', 'rgba', '', '', '', 1),
(@iCategoryId, CONCAT(@sName, '_header_bg_image'), '_bx_uni_stg_cpt_option_header_bg_image', '', 'image', '', '', '', 2),
(@iCategoryId, CONCAT(@sName, '_site_logo'), '_bx_uni_stg_cpt_option_site_logo', '', 'image', '', '', '', 3),
(@iCategoryId, CONCAT(@sName, '_site_logo_alt'), '_bx_uni_stg_cpt_option_site_logo_alt', '', 'text', '', '', '', 4),
(@iCategoryId, CONCAT(@sName, '_site_logo_width'), '_bx_uni_stg_cpt_option_site_logo_width', '240', 'digit', '', '', '', 5),
(@iCategoryId, CONCAT(@sName, '_site_logo_height'), '_bx_uni_stg_cpt_option_site_logo_height', '48', 'digit', '', '', '', 6),
(@iCategoryId, CONCAT(@sName, '_header_content_padding'), '_bx_uni_stg_cpt_option_header_content_padding', '0px', 'digit', '', '', '', 7),
(@iCategoryId, CONCAT(@sName, '_header_border_color'), '_bx_uni_stg_cpt_option_header_border_color', 'rgba(208, 208, 208, 1)', 'rgba', '', '', '', 8),
(@iCategoryId, CONCAT(@sName, '_header_border_size'), '_bx_uni_stg_cpt_option_header_border_size', '0px', 'digit', '', '', '', 9),
(@iCategoryId, CONCAT(@sName, '_header_shadow'), '_bx_uni_stg_cpt_option_header_shadow', 'none', 'digit', '', '', '', 10),
(@iCategoryId, CONCAT(@sName, '_header_icon_color'), '_bx_uni_stg_cpt_option_header_icon_color', 'rgba(255, 255, 255, 1)', 'rgba', '', '', '', 11),
(@iCategoryId, CONCAT(@sName, '_header_link_color'), '_bx_uni_stg_cpt_option_header_link_color', 'rgba(62, 134, 133, 1)', 'rgba', '', '', '', 12);

-- SETTINGS: UNI Styles Footer
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_styles_footer'), '_bx_uni_stg_cpt_category_styles_footer', 3);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_footer_bg_color'), '_bx_uni_stg_cpt_option_footer_bg_color', 'rgba(255, 255, 255, 1)', 'rgba', '', '', '', 1),
(@iCategoryId, CONCAT(@sName, '_footer_bg_image'), '_bx_uni_stg_cpt_option_footer_bg_image', '', 'image', '', '', '', 2),
(@iCategoryId, CONCAT(@sName, '_footer_content_padding'), '_bx_uni_stg_cpt_option_footer_content_padding', '0px', 'digit', '', '', '', 3),
(@iCategoryId, CONCAT(@sName, '_footer_border_color'), '_bx_uni_stg_cpt_option_footer_border_color', 'rgba(208, 208, 208, 1)', 'rgba', '', '', '', 4),
(@iCategoryId, CONCAT(@sName, '_footer_border_size'), '_bx_uni_stg_cpt_option_footer_border_size', '1px', 'digit', '', '', '', 5),
(@iCategoryId, CONCAT(@sName, '_footer_shadow'), '_bx_uni_stg_cpt_option_footer_shadow', 'none', 'digit', '', '', '', 6),
(@iCategoryId, CONCAT(@sName, '_footer_icon_color'), '_bx_uni_stg_cpt_option_footer_icon_color', 'rgba(62, 134, 133, 1)', 'rgba', '', '', '', 7),
(@iCategoryId, CONCAT(@sName, '_footer_link_color'), '_bx_uni_stg_cpt_option_footer_link_color', 'rgba(62, 134, 133, 1)', 'rgba', '', '', '', 8);

-- SETTINGS: UNI Styles Body
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_styles_body'), '_bx_uni_stg_cpt_category_styles_body', 4);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_body_bg_color'), '_bx_uni_stg_cpt_option_body_bg_color', 'rgb(255, 255, 255)', 'rgb', '', '', '', 1),
(@iCategoryId, CONCAT(@sName, '_body_bg_image'), '_bx_uni_stg_cpt_option_body_bg_image', '', 'image', '', '', '', 2),
(@iCategoryId, CONCAT(@sName, '_page_width'), '_bx_uni_stg_cpt_option_page_width', '1000', 'digit', '', '', '', 3);

-- SETTINGS: UNI Styles Block
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_styles_block'), '_bx_uni_stg_cpt_category_styles_block', 5);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_block_bg_color'), '_bx_uni_stg_cpt_option_block_bg_color', 'rgba(255, 255, 255, 1)', 'rgba', '', '', '', 1),
(@iCategoryId, CONCAT(@sName, '_block_bg_image'), '_bx_uni_stg_cpt_option_block_bg_image', '', 'image', '', '', '', 2),
(@iCategoryId, CONCAT(@sName, '_block_content_padding'), '_bx_uni_stg_cpt_option_block_content_padding', 'inherit', 'digit', '', '', '', 3),
(@iCategoryId, CONCAT(@sName, '_block_border_color'), '_bx_uni_stg_cpt_option_block_border_color', 'rgba(208, 208, 208, 1)', 'rgba', '', '', '', 4),
(@iCategoryId, CONCAT(@sName, '_block_border_size'), '_bx_uni_stg_cpt_option_block_border_size', '0px', 'digit', '', '', '', 5),
(@iCategoryId, CONCAT(@sName, '_block_border_radius'), '_bx_uni_stg_cpt_option_block_border_radius', '0px', 'digit', '', '', '', 6),
(@iCategoryId, CONCAT(@sName, '_block_shadow'), '_bx_uni_stg_cpt_option_block_shadow', 'none', 'digit', '', '', '', 7),
(@iCategoryId, CONCAT(@sName, '_block_title_padding'), '_bx_uni_stg_cpt_option_block_title_padding', '0px', 'digit', '', '', '', 8),
(@iCategoryId, CONCAT(@sName, '_block_title_font_family'), '_bx_uni_stg_cpt_option_block_title_font_family', '"Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif', 'digit', '', '', '', 9),
(@iCategoryId, CONCAT(@sName, '_block_title_font_size'), '_bx_uni_stg_cpt_option_block_title_font_size', '24px', 'digit', '', '', '', 10),
(@iCategoryId, CONCAT(@sName, '_block_title_font_color'), '_bx_uni_stg_cpt_option_block_title_font_color', 'rgba(0, 0, 20, 1)', 'rgba', '', '', '', 11);

-- SETTINGS: UNI Styles Card
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_styles_card'), '_bx_uni_stg_cpt_category_styles_card', 6);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_card_bg_color'), '_bx_uni_stg_cpt_option_card_bg_color', 'rgba(242, 242, 242, 1)', 'rgba', '', '', '', 1),
(@iCategoryId, CONCAT(@sName, '_card_bg_image'), '_bx_uni_stg_cpt_option_card_bg_image', '', 'image', '', '', '', 2),
(@iCategoryId, CONCAT(@sName, '_card_content_padding'), '_bx_uni_stg_cpt_option_card_content_padding', '20px', 'digit', '', '', '', 3),
(@iCategoryId, CONCAT(@sName, '_card_border_color'), '_bx_uni_stg_cpt_option_card_border_color', 'rgba(208, 208, 208, 1)', 'rgba', '', '', '', 4),
(@iCategoryId, CONCAT(@sName, '_card_border_size'), '_bx_uni_stg_cpt_option_card_border_size', '0px', 'digit', '', '', '', 5),
(@iCategoryId, CONCAT(@sName, '_card_border_radius'), '_bx_uni_stg_cpt_option_card_border_radius', '3px', 'digit', '', '', '', 6),
(@iCategoryId, CONCAT(@sName, '_card_shadow'), '_bx_uni_stg_cpt_option_card_shadow', 'none', 'digit', '', '', '', 7);

-- SETTINGS: UNI Styles Large Buttons
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_styles_large_button'), '_bx_uni_stg_cpt_category_styles_large_button', 7);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_button_lg_height'), '_bx_uni_stg_cpt_option_button_lg_height', '36px', 'digit', '', '', '', 1),
(@iCategoryId, CONCAT(@sName, '_button_lg_bg_color'), '_bx_uni_stg_cpt_option_button_lg_bg_color', 'rgba(108, 170, 138, 1)', 'rgba', '', '', '', 2),
(@iCategoryId, CONCAT(@sName, '_button_lg_border_radius'), '_bx_uni_stg_cpt_option_button_lg_border_radius', '3px', 'digit', '', '', '', 3),
(@iCategoryId, CONCAT(@sName, '_button_lg_shadow'), '_bx_uni_stg_cpt_option_button_lg_shadow', 'none', 'digit', '', '', '', 4),
(@iCategoryId, CONCAT(@sName, '_button_lg_font_family'), '_bx_uni_stg_cpt_option_button_lg_font_family', '"Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif', 'digit', '', '', '', 5),
(@iCategoryId, CONCAT(@sName, '_button_lg_font_size'), '_bx_uni_stg_cpt_option_button_lg_font_size', '16px', 'digit', '', '', '', 6),
(@iCategoryId, CONCAT(@sName, '_button_lg_font_color'), '_bx_uni_stg_cpt_option_button_lg_font_color', 'rgba(255, 255, 255, 1)', 'rgba', '', '', '', 7),
(@iCategoryId, CONCAT(@sName, '_button_lg_font_shadow'), '_bx_uni_stg_cpt_option_button_lg_font_shadow', 'none', 'digit', '', '', '', 8),
(@iCategoryId, CONCAT(@sName, '_button_lg_font_weight'), '_bx_uni_stg_cpt_option_button_lg_font_weight', '400', 'digit', '', '', '', 9);

-- SETTINGS: UNI Styles Small Buttons
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_styles_small_button'), '_bx_uni_stg_cpt_category_styles_small_button', 8);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_button_sm_height'), '_bx_uni_stg_cpt_option_button_sm_height', '24px', 'digit', '', '', '', 1),
(@iCategoryId, CONCAT(@sName, '_button_sm_bg_color'), '_bx_uni_stg_cpt_option_button_sm_bg_color', 'rgba(108, 170, 138, 1)', 'rgba', '', '', '', 2),
(@iCategoryId, CONCAT(@sName, '_button_sm_border_radius'), '_bx_uni_stg_cpt_option_button_sm_border_radius', '3px', 'digit', '', '', '', 3),
(@iCategoryId, CONCAT(@sName, '_button_sm_shadow'), '_bx_uni_stg_cpt_option_button_sm_shadow', 'none', 'digit', '', '', '', 4),
(@iCategoryId, CONCAT(@sName, '_button_sm_font_family'), '_bx_uni_stg_cpt_option_button_sm_font_family', '"Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif', 'digit', '', '', '', 5),
(@iCategoryId, CONCAT(@sName, '_button_sm_font_size'), '_bx_uni_stg_cpt_option_button_sm_font_size', '14px', 'digit', '', '', '', 6),
(@iCategoryId, CONCAT(@sName, '_button_sm_font_color'), '_bx_uni_stg_cpt_option_button_sm_font_color', 'rgba(255, 255, 255, 1)', 'rgba', '', '', '', 7),
(@iCategoryId, CONCAT(@sName, '_button_sm_font_shadow'), '_bx_uni_stg_cpt_option_button_sm_font_shadow', 'none', 'digit', '', '', '', 8),
(@iCategoryId, CONCAT(@sName, '_button_sm_font_weight'), '_bx_uni_stg_cpt_option_button_sm_font_weight', '400', 'digit', '', '', '', 9);

-- SETTINGS: UNI Styles Font
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_styles_font'), '_bx_uni_stg_cpt_category_styles_font', 9);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_font_family'), '_bx_uni_stg_cpt_option_font_family', '"Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif', 'digit', '', '', '', 1),
(@iCategoryId, CONCAT(@sName, '_font_size_default'), '_bx_uni_stg_cpt_option_size_default', '18px', 'digit', '', '', '', 2),
(@iCategoryId, CONCAT(@sName, '_font_size_small'), '_bx_uni_stg_cpt_option_size_small', '14px', 'digit', '', '', '', 3),
(@iCategoryId, CONCAT(@sName, '_font_size_middle'), '_bx_uni_stg_cpt_option_size_middle', '16px', 'digit', '', '', '', 4),
(@iCategoryId, CONCAT(@sName, '_font_size_large'), '_bx_uni_stg_cpt_option_size_large', '22px', 'digit', '', '', '', 5),
(@iCategoryId, CONCAT(@sName, '_font_size_h1'), '_bx_uni_stg_cpt_option_size_h1', '38px', 'digit', '', '', '', 6),
(@iCategoryId, CONCAT(@sName, '_font_size_h2'), '_bx_uni_stg_cpt_option_size_h2', '24px', 'digit', '', '', '', 7),
(@iCategoryId, CONCAT(@sName, '_font_size_h3'), '_bx_uni_stg_cpt_option_size_h3', '18px', 'digit', '', '', '', 8);

-- SETTINGS: UNI Viewport Tablet
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_viewport_tablet'), '_bx_uni_stg_cpt_category_viewport_tablet', 10);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_vpt_font_size_scale'), '_bx_uni_stg_cpt_option_vpt_font_size_scale', '100%', 'digit', '', '', '', 1);

-- SETTINGS: UNI Viewport Mobile
INSERT INTO `sys_options_categories`(`type_id`, `name`, `caption`, `order`) VALUES 
(@iTypeId, CONCAT(@sName, '_viewport_mobile'), '_bx_uni_stg_cpt_category_viewport_mobile', 11);
SET @iCategoryId = LAST_INSERT_ID();

INSERT INTO `sys_options`(`category_id`, `name`, `caption`, `value`, `type`, `extra`, `check`, `check_error`, `order`) VALUES
(@iCategoryId, CONCAT(@sName, '_vpm_font_size_scale'), '_bx_uni_stg_cpt_option_vpm_font_size_scale', '85%', 'digit', '', '', '', 1);


-- STUDIO PAGE & WIDGET
INSERT INTO `sys_std_pages`(`index`, `name`, `header`, `caption`, `icon`) VALUES
(3, @sName, '', '', 'bx_uni@modules/boonex/uni/|std-pi.png');
SET @iPageId = LAST_INSERT_ID();

SET @iParentPageId = (SELECT `id` FROM `sys_std_pages` WHERE `name`='home');
SET @iParentPageOrder = (SELECT MAX(`order`) FROM `sys_std_pages_widgets` WHERE `page_id`=@iParentPageId);
INSERT INTO `sys_std_widgets`(`page_id`, `module`, `url`, `click`, `icon`, `caption`, `cnt_notices`, `cnt_actions`) VALUES
(@iPageId, @sName, CONCAT('{url_studio}design.php?name=', @sName), '', 'bx_uni@modules/boonex/uni/|std-wi.png', '_bx_uni_wgt_cpt', '', 'a:4:{s:6:"module";s:6:"system";s:6:"method";s:11:"get_actions";s:6:"params";a:0:{}s:5:"class";s:18:"TemplStudioDesigns";}');
INSERT INTO `sys_std_pages_widgets`(`page_id`, `widget_id`, `order`) VALUES
(@iParentPageId, LAST_INSERT_ID(), @iParentPageOrder + 1);