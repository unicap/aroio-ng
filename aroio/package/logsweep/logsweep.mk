################################################################################
#
# logsweep
#
################################################################################

LOGSWEEP_VERSION = 1.0
LOGSWEEP_SOURCE = Logsweep-$(LOGSWEEP_VERSION).tar.gz
#LOGSWEEP_SITE = file:///home/nicola/workspace/aroio-ng/aroio/Logsweep
LOGSWEEP_SITE = file://$(BR2_EXTRENAL_aroio_PATH)/Logsweep
LOGSWEEP_SITE_METHOD = file
LOGSWEEP_LICENSE = none
LOGSWEEP_INSTALL_IMAGES = YES

define LOGSWEEP_INSTALL_IMAGES_CMDS
	$(INSTALL) -D -m 0644 $(@D)/Start.wav $(BINARIES_DIR)/Logsweep/Start.wav
	$(INSTALL) -D -m 0644 $(@D)/End.wav $(BINARIES_DIR)/Logsweep/End.wav
	$(INSTALL) -D -m 0644 $(@D)/Logsweep96.raw.7z $(BINARIES_DIR)/Logsweep/Logsweep96.raw.7z
endef

$(eval $(generic-package))
