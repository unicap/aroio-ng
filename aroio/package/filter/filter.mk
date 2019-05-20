################################################################################
#
# filter
#
################################################################################

#FILTER_VERSION = 1.0
FILTER_SOURCE = filter.tgz
FILTER_SITE = $(BR2_EXTERNAL_aroio_PATH)/filter
FILTER_SITE_METHOD = local
FILTER_LICENSE = none
FILTER_INSTALL_IMAGES = YES

define FILTER_INSTALL_IMAGES_CMDS
	$(INSTALL) -D -m 0644 $(@D)/filter.tgz $(BINARIES_DIR)/filter.tgz
endef

$(eval $(generic-package))
