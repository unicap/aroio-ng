################################################################################
#
# python-uvicorn
#
################################################################################

PYTHON_UVICORN_VERSION = 0.11.5
PYTHON_UVICORN_SOURCE = uvicorn-$(PYTHON_UVICORN_VERSION).tar.gz
PYTHON_UVICORN_SITE = https://files.pythonhosted.org/packages/9a/dd/8be4cdd599dafb69c1a2a2427eec14b218d9fc047cb0fd41060afc2852a8
PYTHON_UVICORN_SETUP_TYPE = setuptools

$(eval $(python-package))
