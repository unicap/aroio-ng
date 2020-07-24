################################################################################
#
# aroio-webinterface
#
################################################################################

AROIO_WEBINTERFACE_VERSION = b62ae0d5439e8dd72bffe34817cab298c1e8bcb4
AROIO_WEBINTERFACE_GIT_SUBMODULES = YES
AROIO_WEBINTERFACE_SITE_METHOD = git
AROIO_WEBINTERFACE_SITE = git://github.com/aroio/webinterface
AROIO_WEBINTERFACE_LICENSE = MIT
AROIO_UI_DEPENDENCIES = python3 python-uvicorn python-fastapi python-pyjwt

define AROIO_WEBINTERFACE_BUILD_CMDS
	$(TARGET_MAKE_ENV) $(MAKE) $(TARGET_CONFIGURE_OPTS) \
		-C $(@D) all
endef

define AROIO_WEBINTERFACE_INSTALL_TARGET_CMDS
	mkdir -p $(TARGET_DIR)/opt/webinterface
	cp -r $(@D)/frontend/dist/aroio-wi/* $(TARGET_DIR)/opt/webinterface
	cp $(@D)/aroio-webinterface.service $(TARGET_DIR)/lib/systemd/system/
	ln -sf $(TARGET_DIR)/lib/systemd/system/aroio-webinteraface.service $(TARGET_DIR)/lib/systemd/system/multi-user.target.wants/aroio-webinterface.service
endef

$(eval $(generic-package))
