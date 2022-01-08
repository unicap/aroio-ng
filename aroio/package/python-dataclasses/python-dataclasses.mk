################################################################################
#
# python-dataclasses
#
################################################################################

PYTHON_DATACLASSES_VERSION = 0.7
PYTHON_DATACLASSES_SOURCE = dataclasses-$(PYTHON_DATACLASSES_VERSION).tar.gz
PYTHON_DATACLASSES_SITE = https://files.pythonhosted.org/packages/7a/71/fdbab71f1f714e03ead2d264bf444f88379bc09b2937d54ec83894057f80
PYTHON_DATACLASSES_SETUP_TYPE = setuptools
PYTHON_DATACLASSES_LICENSE = Apache-2.0
PYTHON_DATACLASSES_LICENSE_FILES = LICENSE.txt

$(eval $(python-package))
