################################################################################
#
# python-pybluez
#
################################################################################

PYTHON_PYBLUEZ_VERSION = 0.23
PYTHON_PYBLUEZ_SOURCE = pybluez-$(PYTHON_PYBLUEZ_VERSION).tar.gz
PYTHON_PYBLUEZ_SITE = $(call github,pybluez,pybluez,$(PYTHON_PYBLUEZ_VERSION))
PYTHON_PYBLUEZ_SETUP_TYPE = setuptools
PYTHON_PYBLUEZ_LICENSE = GNU2
PYTHON_PYBLUEZ_LICENSE_FILES = docs/license.rst

$(eval $(python-package))
