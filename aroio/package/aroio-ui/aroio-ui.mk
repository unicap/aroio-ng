################################################################################
#
# aroio-ui
#
################################################################################

AROIO_UI_VERSION = bade126b5b0c056951eb3fa0b50e9d50c5069cde
AROIO_UI_GIT_SUBMODULES = YES
AROIO_UI_SITE_METHOD = git
AROIO_UI_SITE = git://github.com/worosom/aroio-ui
AROIO_UI_LICENSE = MIT
AROIO_UI_DEPENDENCIES = python3 python-flask

define AROIO_UI_BUILD_CMDS
	$(TARGET_MAKE_ENV) $(MAKE) $(TARGET_CONFIGURE_OPTS) \
		-C $(@D) all
endef

define AROIO_UI_INSTALL_TARGET_CMDS
	mkdir -p $(TARGET_DIR)/opt/aroio-ui
	cp -r $(@D)/dist/* $(TARGET_DIR)/opt/aroio-ui
	cp $(@D)/aroio-ui.service $(TARGET_DIR)/lib/systemd/system/
	ln -sf $(TARGET_DIR)/lib/systemd/system/aroio-ui.service $(TARGET_DIR)/lib/systemd/system/multi-user.target.wants/aroio-ui.service
endef

$(eval $(generic-package))
