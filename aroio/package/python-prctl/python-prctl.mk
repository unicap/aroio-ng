################################################################################
#
# python-prctl
#
################################################################################

PYTHON_PRCTL_VERSION = 1.8.1
PYTHON_PRCTL_SOURCE = python-prctl-$(PYTHON_PRCTL_VERSION).tar.gz
PYTHON_PRCTL_SITE = $(call github,seveas,python-prctl,v$(PYTHON_PRCTL_VERSION))
PYTHON_PRCTL_SETUP_TYPE = setuptools
PYTHON_PRCTL_LICENSE = GNU2
PYTHON_PRCTL_LICENSE_FILES = docs/license.rst

$(eval $(python-package))
